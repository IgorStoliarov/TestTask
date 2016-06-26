<?php

namespace ORO\ChainCommandBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Exception\LogicException;

abstract class MemberCommand extends ContainerAwareCommand
{
    protected $member = false;

    protected $master = '';

    protected $masterAccess = false;


    protected function setMaster($name)
    {
        $this->master = $name;
        $this->member = true;
    }

    public function getMaster()
    {
        return $this->master;
    }

    public function setMasterAccess()
    {
        $this->masterAccess = true;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($this->member && !$this->masterAccess) {

            $name = $this->getName();
            throw new LogicException("$name command is a member of $this->master command chain and cannot be executed on its own");
        }

        $this->memberExecute($input, $output);
    }

    abstract public function memberExecute(InputInterface $input, OutputInterface $output);
}
