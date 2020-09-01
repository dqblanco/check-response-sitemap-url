<?php namespace Console;

use CheckUrlSiteMap;
use SimpleXMLElement;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class CheckUrlSiteMapCommand extends Command
{
    /**
     * @var CheckUrlSiteMap
     */
    protected $checkUrlSiteMap;

    public function __construct()
    {
        parent::__construct();
    }

    public function configure()
    {
        $this->setName('check-url-sitemap:check')
            ->setDescription('Lee un site map y valida el código de repuesta')
            ->setHelp('Help here')
            ->addArgument('urlSiteMap', InputArgument::REQUIRED, 'Url del mapa del sitio a validar');
    }
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->initCli($input, $output);

        //Captura los datos de entrada
        $urlSiteMap = $input->getArgument('urlSiteMap');
        $openFileXml = file_get_contents($urlSiteMap);

        if($openFileXml){
            $this->checkUrlSiteMap = new CheckUrlSiteMap(new SimpleXMLElement($openFileXml));
            $output->writeln('<info>Leyendo '.$urlSiteMap.'</info>');
            $this->checkUrlSiteMap->checkSiteMap();

        }else{
            $output->writeln('<error>No es posible abrir el archivo xml</error>');
        }


       // $output->writeln($checkUrlSiteMap);

        //Only numbers
        /*if(is_numeric($from) && is_numeric($to)){
            $this->colorTest($input, $output);
            $output->writeln('<info>From: </info>'.$from);
            $output->writeln('<info>To: </info>'.$to);
            for ($i = 0; $i < $input->getOption('iterations'); $i++) {
                $output->writeln('Iteration: '.$i.' <comment>Result: '.($from + $to).'</comment>');
            }
        }else{
            $output->writeln('<error>Please, send me two numbers. Thanks</error>');
        }*/

        $output->writeln('');
        $this->endCli($input, $output);
        return Command::SUCCESS;
    }
}