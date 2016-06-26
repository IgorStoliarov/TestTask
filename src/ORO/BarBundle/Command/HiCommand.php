<?php

namespace ORO\BarBundle\Command;

use ORO\ChainCommandBundle\Command\MemberCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class HiCommand extends MemberCommand
{
    protected function configure()
    {
        $this->setName('bar:hi');
        $this->setMaster('foo:hello');
    }

    public function memberExecute(InputInterface $input, OutputInterface $output)
    {
        $text = 'Hi from Bar!';
        $output->writeln($text);

        return $text;
    }
}
