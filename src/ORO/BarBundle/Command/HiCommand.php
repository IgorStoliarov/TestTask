<?php

namespace ORO\BarBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class HiCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('bar:hi');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $text = 'Hi from Bar!';
        $output->writeln($text);
    }
}
