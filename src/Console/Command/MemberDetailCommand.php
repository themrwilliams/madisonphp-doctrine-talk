<?php
namespace Console\Command;


use Console\Command\EntityManagerAwareCommand;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MemberDetailCommand extends EntityManagerAwareCommand {

    public function __construct($name, $em) {
        parent::__construct($name, $em);
    }
    protected function configure() {
        $this->setName('members:detail')
            ->setDescription('Provide details about a Member')
            ->setDefinition(array(
            ))
            ->setHelp(<<<EOT
The <info>members:detail</info> provides various ways of listing members.
EOT
            )
            ->addArgument(
                'id',
                InputArgument::REQUIRED,
                'ID of the Member to fetch detail of.'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        /** @var \Entity\Member $member */
        $member = $this->em->find('Entity\Member', $input->getArgument('id'));

        $output->writeln('Member Name: ' . $member->getName());
        $output->writeln('Joined On: ' . $member->getCreatedOn()->format('Y-m-d'));
        $output->writeln('');

        $output->writeln('MEETUP MEMBERSHIP:');

        $meetups = $member->getMeetups();
        if (count($meetups) > 0) {
            foreach($member->getMeetups() as $meetup) {
                $output->writeln(' * ' . $meetup->getName());
            }
        } else {
            $output->writeln('This person has not joined any meetups. What a bum!');
        }

        $events = $member->getEvents();

        $output->writeln('');
        $output->writeln('ATTENDANCE:');

        if (count($events) > 0) {
            /** @var $table \Symfony\Component\Console\Helper\TableHelper */
            $table      = $this->getHelperSet()->get('table');
            $rows       = array();

            $table->setHeaders(array('Meetup','Title','When','Role'));

            /** @var \Entity\Event $event */
            foreach($events as $event) {
                $rows[] = array(
                    'Meetup'  => $event->getMeetup()->getName(),
                    'Title'   => $event->getTitle(),
                    'When'    => $event->getWhen()->format('Y-m-d'),
                    'Speaker' => $event->getSpeaker()->getId() == $member->getId() ? 'Speaker' : 'Attendee'
                );
            }

            $table->addRows($rows);
            $table->render($output);
        } else {
            $output->writeln('This person has not attended a single Meetup! Pitiful!');
        }
    }
}
