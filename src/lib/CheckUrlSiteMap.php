<?php

namespace Console\lib;

use Exception;
use SimpleXMLElement;
use Symfony\Component\Console\Output\OutputInterface;

class CheckUrlSiteMap
{

    /**
     * @var SimpleXMLElement
     */
    protected $simpleXMLElement;

    /**
     * @var string
     */
    protected string $pathLog404;

    /**
     * @var string
     */
    protected string $pathLog200;

    /**
     * @var string
     */
    protected string $pathLog500;

    /**
     * @var string
     */
    protected string $pathLogOthers;

    /**
     * @var OutputInterface
     */
    protected OutputInterface $output;
    /**
     * @var string
     */
    protected string $urlOpenFile;

    /**
     * CheckUrlSiteMap constructor.
     * @param SimpleXMLElement $simpleXMLElement
     * @param string $pathLog404
     * @param string $pathLog200
     * @param string $pathLog500
     * @param string $pathLogOthers
     */
    public function __construct(SimpleXMLElement $simpleXMLElement, string $pathLog404, string $pathLog200, string $pathLog500, string $pathLogOthers)
    {
        $this->simpleXMLElement = $simpleXMLElement;
        $this->pathLog404 = $pathLog404;
        $this->pathLog200 = $pathLog200;
        $this->pathLog500 = $pathLog500;
        $this->pathLogOthers = $pathLogOthers;
    }

    /**
     * Check Site Map
     * @param OutputInterface $output
     * @throws Exception
     */
    public function checkSiteMap(OutputInterface $output): void
    {
        $this->output = $output;
        if(count($this->simpleXMLElement->sitemap)){
            $this->readSiteMap();
        }else{
            $this->readUrlSiteMap();
        }

    }

    /**
     * @throws Exception
     */
    public function readSiteMap(): true
    {
        foreach($this->simpleXMLElement->sitemap as $internalNode){
            if($internalNode->loc){
                $openFileXml = file_get_contents($internalNode->loc);
                $checkSiteMap = new CheckUrlSiteMap(new SimpleXMLElement($openFileXml),$this->pathLog404, $this->pathLog200, $this->pathLog500, $this->pathLogOthers);
                $checkSiteMap->checkSiteMap($this->output);
            }
        }
        return true;
    }


    public function readUrlSiteMap(): true
    {
        foreach($this->simpleXMLElement->url as $internalNode){
            $url_file = $internalNode->loc;
            $curl_file = curl_init($url_file);
            //User if the urls are basic Authentication
            //curl_setopt($curl_file, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            //curl_setopt($curl_file, CURLOPT_USERPWD, "user:password");
            curl_setopt($curl_file, CURLOPT_NOBODY, true);
            $result_file = curl_exec($curl_file);

            if ($result_file !== false) {
                $statusCode = curl_getinfo($curl_file, CURLINFO_HTTP_CODE);

                $this->output->writeln('<comment>'.$url_file.': '.$statusCode.'</comment>');

                if ($statusCode == 404) {
                    $file = fopen($this->getPathLog404(),"a+");
                }elseif ($statusCode == 200) {
                    $file = fopen($this->getPathLog200(),"a+");
                }elseif ($statusCode == 403) {
                    $file = fopen($this->getPathLogOthers(),"a+");

                }elseif ($statusCode == 500) {
                    $file = fopen($this->getPathLog500(),"a+");
                }else{
                    $file = fopen($this->getPathLogOthers(),"a+");
                }
                fputs($file,$internalNode->loc."\n");
            }
        }
        return true;
    }

    /**
     * @return string
     */
    public function getPathLog404(): string
    {
        return $this->pathLog404;
    }

    /**
     * @param string $pathLog404
     */
    public function setPathLog404(string $pathLog404): void
    {
        $this->pathLog404 = $pathLog404;
    }

    /**
     * @return string
     */
    public function getPathLog200(): string
    {
        return $this->pathLog200;
    }

    /**
     * @param string $pathLog200
     */
    public function setPathLog200(string $pathLog200): void
    {
        $this->pathLog200 = $pathLog200;
    }

    /**
     * @return string
     */
    public function getPathLog500(): string
    {
        return $this->pathLog500;
    }

    /**
     * @param string $pathLog500
     */
    public function setPathLog500(string $pathLog500): void
    {
        $this->pathLog500 = $pathLog500;
    }

    /**
     * @return string
     */
    public function getPathLogOthers(): string
    {
        return $this->pathLogOthers;
    }

    /**
     * @param string $pathLogOthers
     */
    public function setPathLogOthers(string $pathLogOthers): void
    {
        $this->pathLogOthers = $pathLogOthers;
    }

    /**
     * @return SimpleXMLElement
     */
    public function getSimpleXMLElement(): SimpleXMLElement
    {
        return $this->simpleXMLElement;
    }

    /**
     * @param SimpleXMLElement $simpleXMLElement
     */
    public function setSimpleXMLElement($simpleXMLElement): void
    {
        $this->simpleXMLElement = $simpleXMLElement;
    }

    /**
     * @return string
     */
    public function getUrlOpenFile(): string
    {
        return $this->urlOpenFile;
    }

    /**
     * @param string $urlOpenFile
     */
    public function setUrlOpenFile(string $urlOpenFile): void
    {
        $this->urlOpenFile = $urlOpenFile;
    }
}