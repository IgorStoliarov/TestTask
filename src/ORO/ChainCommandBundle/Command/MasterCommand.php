<?php

namespace ORO\ChainCommandBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class MasterCommand extends ContainerAwareCommand
{
    protected function executeMembers(InputInterface $input, OutputInterface $output)
    {
        foreach($this->getApplication()->all() as $command) {

            if ($command instanceof MemberCommand) {
                if ($command->getMaster() == $this->getName()) {
                    $command->setMasterAccess();
                    $command->run($input, $output);
                }
            }
        }
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $logger = $this->getContainer()->get('logger');

        $name = $this->getName();

        $logger->info("$name is a master command of a command chain that has registered member commands");

        $this->masterExecute($input, $output);

        $this->executeMembers($input, $output);

        $logger->info("Execution of $name chain completed.");
    }

    abstract protected function masterExecute(InputInterface $input, OutputInterface $output);
}
