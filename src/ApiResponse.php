<?php


namespace FNDev\Proxmox;

use FNDev\Proxmox\Exceptions\AuthenticationException;
use FNDev\Proxmox\Exceptions\ParameterVerificationException;
use Psr\Http\Message\ResponseInterface;

class ApiResponse
{
    public static array $Exceptions=[
        ParameterVerificationException::class=>"Parameter verification failed.\n",
        AuthenticationException::class=>"authentication failure\n"
    ];


    public static function throwError(ResponseInterface $response){
        $jsonDecodedResponse=json_decode($response->getBody());
        switch ($jsonDecodedResponse->status){
            case "400" :return self::whichBadRequestException($response);
            case "401":throw new AuthenticationException(json_encode($jsonDecodedResponse));
        }

    }
    public static function HasError(ResponseInterface $response){
        $jsonDecodedResponse=json_decode($response->getBody());
        if(null==$jsonDecodedResponse->data &&$jsonDecodedResponse->success==0){
            return self::throwError($response);
        }
        return false;

    }
    public static function whichBadRequestException(ResponseInterface $response){
        $jsonDecodedResponse=json_decode($response->getBody());
        $key=array_search($jsonDecodedResponse->message,self::$Exceptions);
        throw new $key(json_encode($jsonDecodedResponse));
    }



}