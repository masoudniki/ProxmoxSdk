<?php
namespace FNDev\Proxmox\Traits;

use FNDev\Proxmox\ApiResponse;
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
            return $this->checkResponse($this->httpClient->post($path,[
                "form_params"=>$params
            ]));
        }
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