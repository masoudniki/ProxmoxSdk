<?php

namespace FNDev\Proxmox\Api\Access;
use FNDev\Proxmox\Api\AbstractClasses\AddHttpClient;
use FNDev\Proxmox\Api\Access\Users\Users;
use FNDev\Proxmox\ApiResponse;

class Access extends AddHttpClient
{
    public function Users(){
        return new Users($this->httpClient);
    }
    public function changePassword($id,$password){
        $response=$this->httpClient->put("/access/password",[
            "form_params"=>[
                "password"=>$password,
                "userid"=>$id
            ]
        ]);
        if(!ApiResponse::HasError($response)){
            return json_decode($response->getBody());
        }
    }
    public function getTicket(){
        $response=$this->httpClient->get("access/ticket");
        if(!ApiResponse::HasError($response)){
            return json_decode($response->getBody());
        }

    }
    public function ticket(TicketParameters $parameters){
        $response=$this->httpClient->post("access/ticket",[
            "form_params"=>$parameters->getParameters()
        ]);
        if(!ApiResponse::HasError($response)){
            return json_decode($response->getBody());
        }
    }

}