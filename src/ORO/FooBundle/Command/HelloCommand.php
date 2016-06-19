<?php

namespace ORO\FooBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\OutputInterface;

class HelloCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('foo:hello');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $text = 'Hello from Foo!';
        $output->writeln($text);

        $command = $this->getApplication()->find('bar:hi');
        $returnCode = $command->run($input, $output);

        $logger = new ConsoleLogger($output);
        $logger->info('test');
    }
}
