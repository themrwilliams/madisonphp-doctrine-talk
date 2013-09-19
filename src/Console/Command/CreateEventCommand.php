<?php
namespace Console\Command;


use Console\Command\EntityManagerAwareCommand;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

use Entity\Event;

class CreateEventCommand extends EntityManagerAwareCommand {

    public function __construct($name, $em) {
        parent::__construct($name, $em);
    }
    protected function configure() {
        $this->setName('events:create')
            ->setDescription('Create a new Event record')
            ->setDefinition(array(
            ))
            ->setHelp(<<<EOT
The <info>event:create</info> creates a new Member entity (row) in the database.
EOT
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        /** @var $dialog \Symfony\Component\Console\Helper\DialogHelper */
        $dialog = $this->getHelperSet()->get('dialog');

        $meetupId  = $dialog->ask($output, '<fg=green>What is the ID of the Meetup this event is for?</fg=green> ');
        $title     = $dialog->ask($output, '<fg=green>What title should we give to the new event?</fg=green> ');
        $when      = $dialog->ask($output, '<fg=green>When will this event occur?</fg=green> ');
        $where     = $dialog->ask($output, '<fg=green>Where will this event occur?</fg=green> ');
        $speakerId = $dialog->ask($output, '<fg=green>What is the ID of the Member who will be speaking?</fg=green> ');

        $meetup  = $this->em->find('Entity\Meetup', $meetupId);
        $speaker = $this->em->find('Entity\Member', $speakerId);

        $event = new Event();
        $event->setMeetup($meetup);
        $event->setSpeaker($speaker);
        $event->setTitle($title);
        $event->setWhere($where);
        $event->setWhen(new \DateTime($when));

        $speaker->getEvents()->add($event);

        $this->em->persist($event);
        $this->em->flush();

        $output->writeln(
            sprintf('A new Event named %s was added (ID %d)', $event->getTitle(), $event->getId())
        );
    }
}
