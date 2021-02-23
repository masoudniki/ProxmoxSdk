<?php
    namespace FNDev\Proxmox\Auth;

use FNDev\Proxmox\ApiResponse;
use FNDev\Proxmox\ProxmoxApiClient;
use GuzzleHttp\Client;

class CookieHandler{
    public static $cookie;
    public static function getCookie(ProxmoxApiClient $client){
        if(self::$cookie)
            return self::$cookie;
        else
            return self::$cookie=self::AuthRequest($client);
    }
    public static function AuthRequest(ProxmoxApiClient $client){
            $HttpClient=new Client(
                [
                    "verify"=>$client->ssl,
                    "Content-Type"=>"application/x-www-form-urlencoded",
                    "User-Agent"=>"User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36",
                    "X-Requested-With: XMLHttpRequest"
                ]
            );
            $response=$HttpClient->request("POST",$client->getAuthUrl(),[
             "form_params"=>[
                 "username"=>'sss',
                 "password"=>$client->password,
                 "relam"=>"pmg"
             ]
         ]);
            ApiResponse::HasError($response);

    }













}