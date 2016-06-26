<?php

namespace ORO\FooBundle\Command;

use ORO\ChainCommandBundle\Command\MasterCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class HelloCommand extends MasterCommand
{
    protected function configure()
    {
        $this->setName('foo:hello');
    }

    protected function masterExecute(InputInterface $input, OutputInterface $output)
    {
        $text = 'Hello from Foo!';
        $output->writeln($text);

        return $text;
    }
}
