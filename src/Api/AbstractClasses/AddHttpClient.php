<?php

namespace  FNDev\Proxmox\Api\AbstractClasses;

use GuzzleHttp\Client;

Abstract class AddHttpClient
{
    public Client $httpClient;
    public function __construct(Client $client)
    {
        $this->httpClient=$client;
    }

}