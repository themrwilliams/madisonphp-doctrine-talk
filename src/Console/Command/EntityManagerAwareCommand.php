<?php
namespace Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class EntityManagerAwareCommand extends Command {
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    public function __construct($name, $em) {
        parent::__construct($name);
        $this->em = $em;
    }
}
