<?php
namespace FNDev\Proxmox\Api\Config;

use FNDev\Proxmox\Api\AbstractClasses\AddHttpClient;
use FNDev\Proxmox\ProxmoxApiClient;
use FNDev\Proxmox\Traits\MakeRequest;

class Config extends AddHttpClient
{
    use MakeRequest;
    public function getAdminConfiguration(){
        return $this->makeRequest(ProxmoxApiClient::GET,"config/admin");
    }
    public function updateAdminConfiguration(AdminConfig $config){
        return $this->makeRequest(ProxmoxApiClient::PUT,"config/admin",$config->getParameters());
    }
    public function getClamavConfiguration(){
        return $this->makeRequest(ProxmoxApiClient::GET,"config/clamav");
    }
    public function updateClamavConfiguration(ClamavConfig $config){
        return $this->makeRequest(ProxmoxApiClient::PUT,"config/clamav",$config->getParameters());
    }
    public function getMailConfiguration(){
        return $this->makeRequest(ProxmoxApiClient::GET,"config/mail");
    }


}