<?php

namespace FNDev\Proxmox\Api\Quarantine;

use FNDev\Proxmox\Api\AbstractClasses\AddHttpClient;
use FNDev\Proxmox\Api\Quarantine\BlackList\BlackList;
use FNDev\Proxmox\Api\Quarantine\WhiteList\WhiteList;
use FNDev\Proxmox\ApiResponse;

class Quarantine extends AddHttpClient
{
    const WHITELIST="whitelist";
    const BLACKLIST="blacklist";
    const DELIVER="deliver";
    const DELETE="delete";
    const ACTIONS=[
        self::WHITELIST,
        self::BLACKLIST,
        self::DELIVER,
        self::DELETE
    ];
    public function BlackList(){
        return new BlackList($this->httpClient);
    }

    public function WhiteList(){
        return new WhiteList($this->httpClient);
    }

    public function attachment($starttime=null,$endtime=null){
        $response=$this->httpClient->get("quarantine/attachment",[
            "query"=>[
                "starttime"=>$starttime,
                "endtime"=>$endtime
            ]
        ]);
        if(!ApiResponse::HasError($response)){
            return json_decode($response->getBody());
        }

    }
    public function getContent(int $id,bool $raw=false){
        $response=$this->httpClient->get("quarantine/content",[
            "query"=>[
                "id"=>$id,
                "raw"=>$raw
            ]
        ]);
        if(!ApiResponse::HasError($response)){
            return json_decode($response->getBody());
        }
    }
    public function content(string $id,$action){
        if(false===array_search($action,self::ACTIONS)){
            throw new \InvalidArgumentException("only provided values are acceptable.");
        }
        $response=$this->httpClient->post("quarantine/content",[
            "form_params"=>$action,
            "id"=>$id
        ]);
        if(!ApiResponse::HasError($response)){
            return json_decode($response->getBody());
        }
    }
    public function download(string $mailid,int $attachmentid=null){
        $response=$this->httpClient->get("quarantine/download",[
            "query"=>[
                "mailid"=>$mailid,
                "attachmentid"=>$attachmentid
            ]
        ]);
        if(!ApiResponse::HasError($response)){
            return json_decode($response->getBody());
        }
    }
    public function listattachment(string $id){
        $response=$this->httpClient->get("quarantine/listattachments",[
            "query"=>[
                "id"=>$id
            ]
        ]);
        if(!ApiResponse::HasError($response)) {
            return json_decode($response->getBody());
        }
    }
    public function quarusers(){
        $response=$this->httpClient->get("quarantine/quarusers");
        if(ApiResponse::HasError($response)){
            return json_decode($response->getBody());
        }

    }





}