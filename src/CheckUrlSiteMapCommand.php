<?php

namespace Console;

use Console\lib\CheckUrlSiteMap;
use SimpleXMLElement;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;

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
            $pathLog404 = __DIR__."../../var/log/400.log";
            $pathLog200 = __DIR__."../../var/log/200.log";
            $pathLog500 = __DIR__."../../var/log/500.log";
            $pathLogOthers = __DIR__."../../var/log/other.log";

            $this->checkUrlSiteMap = new CheckUrlSiteMap(new SimpleXMLElement($openFileXml),$pathLog404, $pathLog200, $pathLog500, $pathLogOthers);
            $output->writeln('<info>Leyendo '.$urlSiteMap.'</info>');
            $this->checkUrlSiteMap->checkSiteMap($output);
        }else{
            $output->writeln('<error>No es posible abrir el archivo xml</error>');
        }

        $output->writeln('');
        $this->endCli($input, $output);
        return Command::SUCCESS;
    }
}