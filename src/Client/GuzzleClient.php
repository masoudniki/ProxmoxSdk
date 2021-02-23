<?php

namespace FNDev\Proxmox\Client;

use FNDev\Proxmox\Auth\CookieHandler;
use FNDev\Proxmox\ProxmoxApiClient;
use GuzzleHttp\Client;

class GuzzleClient extends Client
{
    public function __construct(ProxmoxApiClient $client,array $config = [])
    {
        $guzzleConfig = array_merge([
            'base_uri' => $client->getBaseUrl(),
            "verify"=>$client->ssl,
            'headers' => [
                'Cookie' => 'Bearer '.CookieHandler::getCookie($client),
                'Content-Type' => 'application/json',
            ],
        ], $config);
        parent::__construct($config);
    }


}