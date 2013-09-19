<?php
namespace Console\Command;


use Console\Command\EntityManagerAwareCommand;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ListMembersCommand extends EntityManagerAwareCommand {

    public function __construct($name, $em) {
        parent::__construct($name, $em);
    }
    protected function configure() {
        $this->setName('members:list')
            ->setDescription('List members')
            ->setDefinition(array(
        ))
            ->setHelp(<<<EOT
The <info>members:list</info> provides various ways of listing members.
EOT
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $repository = $this->em->getRepository('Entity\Member');
        /** @var $table \Symfony\Component\Console\Helper\TableHelper */
        $table      = $this->getHelperSet()->get('table');
        $rows       = array();

        $table->setHeaders(array('ID', 'Name', 'Date Created'));

        foreach($repository->findAll() as $member) {
            $rows[] = array(
                'id'        => $member->getId(),
                'name'      => $member->getName(),
                'createdOn' => $member->getCreatedOn()->format('F j, Y, g:i a (T)'),
            );
        }

        $table->addRows($rows);
        $table->render($output);
    }
}
