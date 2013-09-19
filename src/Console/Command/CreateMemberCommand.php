<?php
namespace Console\Command;


use Console\Command\EntityManagerAwareCommand;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class CreateMemberCommand extends EntityManagerAwareCommand {

    public function __construct($name, $em) {
        parent::__construct($name, $em);
    }
    protected function configure() {
        $this->setName('members:create')
            ->setDescription('Create a new member record')
            ->setDefinition(array(
        ))
            ->setHelp(<<<EOT
The <info>members:create</info> creates a new Member entity (row) in the database.
EOT
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        /** @var $dialog \Symfony\Component\Console\Helper\DialogHelper */
        $dialog = $this->getHelperSet()->get('dialog');

        $name = $dialog->ask($output, '<fg=green>What name should we give to the new member?</fg=green> ');

        $member = new \Entity\Member();
        $member->setName($name);

        $this->em->persist($member);
        $this->em->flush();

        $output->writeln(
            sprintf('A new member named %s was added (ID %d)', $member->getName(), $member->getId())
        );
    }
}
