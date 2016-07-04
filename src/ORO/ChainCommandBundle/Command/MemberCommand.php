<?php

namespace ORO\ChainCommandBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Exception\LogicException;

/**
 * Class MemberCommand
 * Have to be extended for creation of member command
 */
abstract class MemberCommand extends ContainerAwareCommand
{
    /**
     * Did this command registered as member or not
     *
     * @var bool
     */
    protected $member = false;

    /**
     * Name of master command
     *
     * @var string
     */
    protected $master = '';

    /**
     * Does master access to this command allowed 
     *
     * @var bool
     */
    protected $masterAccess = false;


    /**
     * Set master command
     * 
     * @param $name
     */
    protected function setMaster($name)
    {
        $this->master = $name;
        $this->member = true;
    }

    /**
     * Get master command
     * 
     * @return string
     */
    public function getMaster()
    {
        return $this->master;
    }

    /**
     * Set maser access
     */
    public function setMasterAccess()
    {
        $this->masterAccess = true;
    }

    /**
     * Runs standard command execution in case it wasn't registered as member of chain
     * Otherwise throws an exception
     * 
     * @param InputInterface $input
     * @param OutputInterface $output
     * 
     * @return mixed
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($this->member && !$this->masterAccess) {

            $name = $this->getName();
            throw new LogicException("$name command is a member of $this->master command chain and cannot be executed on its own");
        }

        $this->memberExecute($input, $output);
    }

    /**
     * Abstract function that provides main logic of command itself
     * Must be realized in every created member command
     * 
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return mixed
     */
    abstract public function memberExecute(InputInterface $input, OutputInterface $output);
}
