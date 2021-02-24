<?php


namespace FNDev\Proxmox\Api\Access\Users;


use FNDev\Proxmox\Api\AbstractClasses\AddHttpClient;
use FNDev\Proxmox\ApiResponse;

class Users extends AddHttpClient
{
    public function all(){
        $response=$this->httpClient->get("access/users");
        if(!ApiResponse::HasError($response)){
            return json_decode($response->getBody())->data;
        }
    }
    public function getById($id){
        $response=$this->httpClient->get("access/users/$id");
        if(!ApiResponse::HasError($response)){
            return json_decode($response->getBody())->data;
        }
    }
    public function edit(EditUserParameter $parameter,$id){
        $response=$this->httpClient->put("access/users/$id",[
            "form_params"=>$parameter->getParameters()
        ]);
        if(!ApiResponse::HasError($response)){
            return json_decode($response->getBody());
        }
    }
    public function delete($id){
        $response=$this->httpClient->delete("/access/users/$id");
        if(!ApiResponse::HasError($response)){
            return json_decode($response->getBody());
        }
    }
}