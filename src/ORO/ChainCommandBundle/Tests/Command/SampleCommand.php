<?php

namespace ORO\ChainCommandBundle\Tests\Command;

use ORO\ChainCommandBundle\Command\MasterCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class SampleCommand
 * Created for using in tests
 */
class SampleCommand extends MasterCommand
{
    protected function configure()
    {
        $this->setName('master:sample');
    }

    protected function masterExecute(InputInterface $input, OutputInterface $output)
    {
        $text = 'Sample text';
        $output->writeln($text);

        return $text;
    }
}
