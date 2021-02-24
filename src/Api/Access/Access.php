<?php

namespace FNDev\Proxmox\Api\Access;
use FNDev\Proxmox\Api\AbstractClasses\AddHttpClient;
use FNDev\Proxmox\Api\Access\Users\Users;

class Access extends AddHttpClient
{
    public function Users(){
        return new Users($this->httpClient);
    }

}