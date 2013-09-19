<?php
namespace Console\Command;


use Console\Command\EntityManagerAwareCommand;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class CreateMeetupCommand extends EntityManagerAwareCommand {

    public function __construct($name, $em) {
        parent::__construct($name, $em);
    }
    protected function configure() {
        $this->setName('meetups:create')
            ->setDescription('Create a new meetup record')
            ->setDefinition(array(
        ))
            ->setHelp(<<<EOT
The <info>meetups:create</info> creates a new Meetup entity (row) in the database.
EOT
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        /** @var $dialog \Symfony\Component\Console\Helper\DialogHelper */
        $dialog = $this->getHelperSet()->get('dialog');

        $name    = $dialog->ask($output, '<fg=green>What name should we give to the new meetup?</fg=green> ');
        $ownerId = $dialog->ask($output, '<fg=green>What is the ID of the Member who should own this new Meetup?</fg=green> ');

        $owner = $this->em->find('Entity\Member', $ownerId);

        $meetup = new \Entity\Meetup();
        $meetup->setName($name);
        $meetup->setOwner($owner);

        $owner->getMeetups()->add($meetup);

        $this->em->persist($meetup);
        $this->em->flush();

        $output->writeln(
            sprintf(
                'A new meetup named %s was added (ID %d) and assigned to %s.',
                $meetup->getName(),
                $meetup->getId(),
                $meetup->getOwner()->getName()
            )
        );
    }
}
