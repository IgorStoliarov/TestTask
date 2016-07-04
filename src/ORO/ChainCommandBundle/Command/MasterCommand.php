<?php

namespace ORO\ChainCommandBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class MasterCommand
 * Have to be extended for creation of master command
 */
abstract class MasterCommand extends ContainerAwareCommand
{
    /**
     * Array of member commands
     *
     * @var array
     */
    private $members = [];

    /**
     * First try to find members of chain
     * If there are no members function runs standard command execution
     * Otherwise it runs all chain members as well and provide logging
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * 
     * @return mixed
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->findMembers();

        if ($this->members) {
            $logger = $this->getContainer()->get('logger');

            $name = $this->getName();

            $logger->info("$name is a master command of a command chain that has registered member commands");

            foreach ($this->members as $member) {
                $memberName = $member->getName();
                $logger->info("$memberName registered as a member of $name command chain");
            }

            $logger->info("Executing $name command itself first:");
        }

        $result = $this->masterExecute($input, $output);

        if ($this->members) {

            $logger->info($result);
            $logger->info("Executing $name chain members:");

            $this->executeMembers($input, $output, $logger);

            $logger->info("Execution of $name chain completed.");
        }
    }

    /**
     * Try to find registered member commands of this master through all application commands
     */
    protected function findMembers()
    {
        foreach($this->getApplication()->all() as $command) {

            if ($command instanceof MemberCommand) {
                if ($command->getMaster() == $this->getName()) {
                    $command->setMasterAccess();
                    $this->members[] = $command;
                }
            }
        }
    }

    /**
     * Abstract function that provides main logic of command itself
     * Must be realized in every created master command
     * 
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return mixed
     */
    abstract protected function masterExecute(InputInterface $input, OutputInterface $output);

    /**
     * Execute members registered in this chain
     * 
     * @param InputInterface $input
     * @param OutputInterface $output
     * @param $logger
     */
    protected function executeMembers(InputInterface $input, OutputInterface $output, $logger)
    {
        foreach($this->members as $member) {
            $result = $member->memberExecute($input, $output);
            $logger->info($result);
        }
    }
}
