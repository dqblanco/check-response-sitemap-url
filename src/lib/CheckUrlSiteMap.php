<?php


class CheckUrlSiteMap
{

    /**
     * @var string
     */
    protected $pathLog404;

    /**
     * @var string
     */
    protected $pathLog200;

    /**
     * @var string
     */
    protected $pathLog500;

    /**
     * @var string
     */
    protected $pathLogOthers;

    /**
     * @var SimpleXMLElement
     */
    protected $simpleXMLElement;

    /**
     * @var string|bool
     */
    protected $urlOpenFile;

    public function __construct(SimpleXMLElement $simpleXMLElement ){
        $this->simpleXMLElement = $simpleXMLElement;
    }

    public function checkSiteMap(){
        foreach($this->simpleXMLElement->url as $valInterno){
            $url_file = $valInterno->loc;
            $curl_file = curl_init($url_file);
            curl_setopt($curl_file, CURLOPT_NOBODY, true);
            $result_file = curl_exec($curl_file);

            if ($result_file !== false) {
                $statusCode = curl_getinfo($curl_file, CURLINFO_HTTP_CODE);
                echo $url_file.': '.$statusCode."\n";
                /*if ($statusCode == 404) {
                    $file = fopen($pathLog404,"a");
                    fputs($file,$valInterno->loc."\n");
                }elseif ($statusCode == 200) {
                    $file = fopen($pathLog200,"a");
                    fputs($file,$valInterno->loc."\n");
                }elseif ($statusCode == 403) {
                    $file = fopen($pathLog404,"a");
                    fputs($file,$valInterno->loc."\n");

                }elseif ($statusCode == 500) {
                    $file = fopen($pathLog404,"a");
                    fputs($file,$valInterno->loc."\n");
                }else{
                    echo $statusCode. " ". $valInterno->loc. "\n";
                }*/
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