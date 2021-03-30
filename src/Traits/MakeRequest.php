<?php
namespace FNDev\Proxmox\Traits;

use FNDev\Proxmox\ApiResponse;
use FNDev\Proxmox\ProxmoxApiClient;
use http\Client\Response;
use Psr\Http\Message\ResponseInterface;

trait MakeRequest
{
    public function makeRequest($method,$path,$params=null){
        if($method=="get"){
            return $this->checkResponse($this->httpClient->get($path,[
                "query"=>$params
            ]));
        }
        else{
            return $this->checkResponse($this->httpClient->{$method}($path,$this->normalizeData($params)));
        }
    }
    public function normalizeData(array $params){
        if(!isset($params['form_params']) and !isset($params["query"])){
            return [
                "form_params"=>$params
            ];
        }
        return $params;
    }
    private function generateResponse(ResponseInterface $response){
        return json_decode($response->getBody());
    }
    private function checkResponse(ResponseInterface $response){

        if(!ApiResponse::HasError($response)){

            return $this->generateResponse($response);
        }
    }





}