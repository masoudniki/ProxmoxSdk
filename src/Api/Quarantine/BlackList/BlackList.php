<?php
namespace FNDev\Proxmox\Api\Quarantine\BlackList;

use FNDev\Proxmox\Api\AbstractClasses\AddHttpClient;
use FNDev\Proxmox\ProxmoxApiClient;
use FNDev\Proxmox\Traits\MakeRequest;

class BlackList extends AddHttpClient
{
    use MakeRequest;

    /**
     * Show user blacklist
     * @param string $pmail
     * @return mixed
     */
    public function list(string $pmail){
        return $this->makeRequest(ProxmoxApiClient::GET,"quarantine/blacklist",[
            "pmail"=>$pmail
        ]);
    }

    /**
     * Add user blacklist entries.
     * @param $pmail
     * @param $address
     * @return mixed
     */
    public function add($pmail, $address){
        return $this->makeRequest(ProxmoxApiClient::POST,"quarantine/blacklist",[
            "pmail"=>$pmail,
            "address"=>$address
        ]);
    }

    /**
     * Delete user blacklist entries.
     * @param $pmail
     * @param $address
     * @return mixed
     */
    public function remove($pmail, $address){
        return $this->makeRequest(ProxmoxApiClient::DELETE,"quarantine/blacklist/",[
                "query"=>[
                    "address"=>$address,
                    "pmail"=>$pmail
                ]
        ]);
    }
}