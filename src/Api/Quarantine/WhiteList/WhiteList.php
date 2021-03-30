<?php

namespace FNDev\Proxmox\Api\Quarantine\WhiteList;

use FNDev\Proxmox\Api\AbstractClasses\AddHttpClient;
use FNDev\Proxmox\ProxmoxApiClient;
use FNDev\Proxmox\Traits\MakeRequest;

class WhiteList extends AddHttpClient
{
    use MakeRequest;

    /**
     * Delete user whitelist entries.
     * @param $pmail
     * @param $address
     * @return mixed
     */
    public function add($pmail, $address){
        return $this->makeRequest(ProxmoxApiClient::DELETE,"quarantine/whitelist",[
            "pmail"=>$pmail,
            "address"=>$address
        ]);
    }


}