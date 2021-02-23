<?php


namespace FNDev\Proxmox;


use FNDev\Proxmox\Client\GuzzleClient;
use GuzzleHttp\Client;

class ProxmoxApiClient
{
    public string $username;
    public string $password;
    public string $host;
    public string $baseurl;
    public Client $HttpClient;
    public string $port;
    public  $ssl;
    public string $authurl;
    public string $protocl;


    /**
     * ProxmoxApiClient constructor.
     * @param $username
     * @param $password
     * @param $host
     * @param $port
     * @param $baseurl
     * @param $authurl
     * @param $protocol
     * @param $ssl;
     */
    public function __construct($username, $password, $host,$port,$ssl=false,$protocol="http",$baseurl="/api2/json/",$authurl="/api2/extjs/access/ticket")
    {
        $this->username=$username;
        $this->password=$password;
        $this->host=$host;
        $this->baseurl=$baseurl;
        $this->port=$port;
        $this->ssl=$ssl;
        $this->authurl=$authurl;
        $this->protocl=$protocol;
        $this->HttpClient=new GuzzleClient($this);
    }
    public function getBaseUrl(){
        return $this->addScheme($this->host.":".$this->port."/".trim($this->baseurl,"/")."/",$this->protocl);
    }
    public function getAuthUrl(){
        return  $this->addScheme($this->host.":".$this->port."/".trim($this->authurl,"/"),$this->protocl);
    }
    function addScheme($url, $scheme = 'http')
    {
        return parse_url($url, PHP_URL_SCHEME) === null ?
            $scheme."://" . $url : $url;
    }





}