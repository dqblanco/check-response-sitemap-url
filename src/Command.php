<?php namespace Console;

use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Command extends SymfonyCommand
{
    
    public function __construct()
    {
        parent::__construct();
    }
    protected function initCli(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            '<info>================================================**** INIT SCRIPT: '.date("H:m:s").' ****================================================',
            '===============================================================================================================================</info>',
            '',
        ]);
    }


    protected function endCli(InputInterface $input, OutputInterface $output)
    {
        $output -> writeln([
            '<info>================================================**** END SCRIPT: '.date("H:m:s").'  ****================================================',
            '===============================================================================================================================</info>',
            '',
        ]);
    }

    protected function colorTest(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('****** TEST COLOR ******');

        // green text
        $output->writeln('<info>Green Text</info>');

        // yellow text
        $output->writeln('<comment>Yellow Text</comment>');

        // black text on a cyan background
        $output->writeln('<question>Black text on a cyan background</question>');

        // white text on a red background
        $output->writeln('<error>White text on a red background</error>');

        $output->writeln('');
    }

}