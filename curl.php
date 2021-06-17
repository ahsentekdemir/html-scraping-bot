<?php

class curl
{
    
    private $useragent;
    private $cookies;
    private $cookieFile;
    private $headers  = array();
    private $headerRequested = False;
    private $folloLocation = True;
    private $sslVerifyPeer = False;
    private $sslVerifyHost = False;
    private $returnTransfer = True;

    public function setUseragent($useragent)
    {
        $this->useragent = $useragent;
    }

    public function setCookies($cookies)
    {
        $this->cookies = $cookies;
    }

    public function setCookieFile($cookieFile)
    {
        $this->cookieFile = $cookieFile;
    }

    public function setHeaders($headers)
    {
        $this->headers = $headers;
    }

    public function addHeader($headerKey, $headerValue)
    {
        array_push($this->headers,$headerKey.": ".$headerValue);
    }

    public function get($url)
    {
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL,$url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER,$this->returnTransfer);
        curl_setopt($c, CURLOPT_FOLLOWLOCATION,$this->folloLocation);
        curl_setopt($c, CURLOPT_HEADER, $this->headerRequested );
        if(isset($this->cookies))
        {
            curl_setopt($c, CURLOPT_COOKIE, $this->cookies);
        }
        curl_setopt($c, CURLOPT_HTTPHEADER,$this->headers);
        curl_setopt($c, CURLOPT_SSL_VERIFYHOST,$this->sslVerifyHost );
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, $this->sslVerifyPeer);
        if(!isset($this->cookieFile))
        {
            $this->cookieFile = dirname(__FILE__)."/cookie.dat";
        }
        curl_setopt($c, CURLOPT_COOKIEFILE, $this->cookieFile);
        curl_setopt($c, CURLOPT_COOKIEJAR, $this->cookieFile);


        if(isset($this->useragent))
        {
            curl_setopt($c, CURLOPT_USERAGENT, $this->useragent);
        }
        else
        {
            curl_setopt($c, CURLOPT_USERAGENT, "okhttp/4.5.0");
        }
        $response = curl_exec($c);
        curl_close($c);
        return $response;
    }
}