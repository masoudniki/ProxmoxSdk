<?php


namespace FNDev\Proxmox;

use FNDev\Proxmox\Api\Access\Access;
use FNDev\Proxmox\Api\Config\Config;
use FNDev\Proxmox\Api\Quarantine\Quarantine;
use FNDev\Proxmox\Api\Statistics\Statistics;
use FNDev\Proxmox\Client\GuzzleClient;
use GuzzleHttp\Client;
use PhpParser\Node\Stmt\Static_;

class ProxmoxApiClient
{
    const GET="get";
    const POST="post";
    const PUT="put";
    const DELETE="delete";

    public string $username;
    public string $password;
    public string $host;
    public string $baseurl;
    private Client $HttpClient;
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
    public function Access(){
        return new Access($this->HttpClient);
    }
    public function Config(){
        return new Config($this->HttpClient);
    }
    public function Quarantine(){
        return new Quarantine($this->HttpClient);
    }
    public function Statistics(){
        return new Statistics($this->HttpClient);
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
    public function getHttpClient(){
        return $this->HttpClient;
    }
    public function setHttpClient(Client $client){
        $this->HttpClient=$client;
    }





}