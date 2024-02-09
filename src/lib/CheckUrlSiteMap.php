<?php

namespace Console\lib;

use SimpleXMLElement;
use Symfony\Component\Console\Output\OutputInterface;

class CheckUrlSiteMap
{

    /**
     * @var SimpleXMLElement
     */
    protected $simpleXMLElement;

    /**
     * @var string|null
     */
    protected $pathLog404;

    /**
     * @var string|null
     */
    protected $pathLog200;

    /**
     * @var string|null
     */
    protected $pathLog500;

    /**
     * @var string|null
     */
    protected $pathLogOthers;


    /**
     * @var string|bool
     */
    protected $urlOpenFile;

    /**
     * CheckUrlSiteMap constructor.
     * @param SimpleXMLElement $simpleXMLElement
     * @param string|null $pathLog404
     * @param string|null $pathLog200
     * @param string|null $pathLog500
     * @param string|null $pathLogOthers
     */
    public function __construct(SimpleXMLElement $simpleXMLElement, $pathLog404, $pathLog200, $pathLog500, $pathLogOthers)
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
     */
    public function checkSiteMap(OutputInterface $output){
        foreach($this->simpleXMLElement->url as $internalNode){
            $url_file = $internalNode->loc;
            $curl_file = curl_init($url_file);
            curl_setopt($curl_file, CURLOPT_NOBODY, true);
            $result_file = curl_exec($curl_file);

            if ($result_file !== false) {
                $statusCode = curl_getinfo($curl_file, CURLINFO_HTTP_CODE);

                $output->writeln('<comment>'.$url_file.': '.$statusCode.'</comment>');

                if ($statusCode == 404) {
                    $file = fopen($this->getPathLog404(),"a+");
                    fputs($file,$internalNode->loc."\n");
                }elseif ($statusCode == 200) {
                    $file = fopen($this->getPathLog200(),"a+");
                    fputs($file,$internalNode->loc."\n");
                }elseif ($statusCode == 403) {
                    $file = fopen($this->getPathLogOthers(),"a+");
                    fputs($file,$internalNode->loc."\n");

                }elseif ($statusCode == 500) {
                    $file = fopen($this->getPathLog500(),"a+");
                    fputs($file,$internalNode->loc."\n");
                }else{
                    $file = fopen($this->getPathLogOthers(),"a+");
                    fputs($file,$internalNode->loc."\n");
                }
            }
        }

    }
    /**
     * @return string
     */
    public function getPathLog404()
    {
        return $this->pathLog404;
    }

    /**
     * @param string $pathLog404
     */
    public function setPathLog404($pathLog404)
    {
        $this->pathLog404 = $pathLog404;
    }

    /**
     * @return string
     */
    public function getPathLog200()
    {
        return $this->pathLog200;
    }

    /**
     * @param string $pathLog200
     */
    public function setPathLog200($pathLog200)
    {
        $this->pathLog200 = $pathLog200;
    }

    /**
     * @return string
     */
    public function getPathLog500()
    {
        return $this->pathLog500;
    }

    /**
     * @param string $pathLog500
     */
    public function setPathLog500($pathLog500)
    {
        $this->pathLog500 = $pathLog500;
    }

    /**
     * @return string
     */
    public function getPathLogOthers()
    {
        return $this->pathLogOthers;
    }

    /**
     * @param string $pathLogOthers
     */
    public function setPathLogOthers($pathLogOthers)
    {
        $this->pathLogOthers = $pathLogOthers;
    }

    /**
     * @return SimpleXMLElement
     */
    public function getSimpleXMLElement()
    {
        return $this->simpleXMLElement;
    }

    /**
     * @param SimpleXMLElement $simpleXMLElement
     */
    public function setSimpleXMLElement($simpleXMLElement)
    {
        $this->simpleXMLElement = $simpleXMLElement;
    }

    /**
     * @return bool|string
     */
    public function getUrlOpenFile()
    {
        return $this->urlOpenFile;
    }

    /**
     * @param bool|string $urlOpenFile
     */
    public function setUrlOpenFile($urlOpenFile)
    {
        $this->urlOpenFile = $urlOpenFile;
    }
}