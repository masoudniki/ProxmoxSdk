<?php

namespace FNDev\Proxmox\Api\Quarantine;

use FNDev\Proxmox\Api\AbstractClasses\AddHttpClient;
use FNDev\Proxmox\Api\Quarantine\BlackList\BlackList;
use FNDev\Proxmox\Api\Quarantine\WhiteList\WhiteList;
use FNDev\Proxmox\ApiResponse;
use FNDev\Proxmox\ProxmoxApiClient;
use FNDev\Proxmox\Traits\MakeRequest;

class Quarantine extends AddHttpClient
{
    use MakeRequest;
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
        return $this->makeRequest(ProxmoxApiClient::GET,"quarantine/attachment",[
            "starttime"=>$starttime,
            "endtime"=>$endtime
        ]);
    }
    public function getContent(int $id,bool $raw=false){
        $this->makeRequest(ProxmoxApiClient::GET,"quarantine/content",[
            "id"=>$id,
            "raw"=>$raw
        ]);
    }
    public function content(string $id,$action){
        if(false===array_search($action,self::ACTIONS)){
            throw new \InvalidArgumentException("only provided values are acceptable.");
        }
        return $this->makeRequest(ProxmoxApiClient::POST,"quarantine/content",[
            "form_params"=>$action,
            "id"=>$id
        ]);
    }
    public function download(string $mailid,int $attachmentid=null){
        return $this->makeRequest(ProxmoxApiClient::GET,"quarantine/download",[
            "mailid"=>$mailid,
            "attachmentid"=>$attachmentid
        ]);
    }
    public function listattachment(string $id){
        return $this->makeRequest(ProxmoxApiClient::GET,"quarantine/listattachments",[
                "id"=>$id
            ]);
    }
    public function quarusers($list=null){
        return $this->makeRequest(ProxmoxApiClient::GET,"quarantine/quarusers",[
            "list"=>$list
        ]);
    }
    public function sendlink(string $mail){
        return $this->makeRequest(ProxmoxApiClient::POST,"quarantine/sendlink",[
            "mail"=>$mail
        ]);
    }
    public function spam($pmail=null,$starttime=null,$endtime=null){
        return $this->makeRequest(ProxmoxApiClient::GET,"quarantine/spam",[
                "pmail"=>$pmail,
                "starttime"=>$starttime,
                "endtime"=>$endtime
        ]);
    }
    public function spamStatus(){
       return $this->makeRequest(ProxmoxApiClient::GET,"quarantine/spamstatus");
    }

    public function spamUsers($starttime=null,$endtime=null){
        return $this->makeRequest(ProxmoxApiClient::GET,"quarantine/spamusers",[
            "starttime"=>$starttime,
            "endtime"=>$endtime
        ]);
    }
    public function virus($starttime=null,$endtime=null){
        return $this->makeRequest(ProxmoxApiClient::GET,"quarantine/virus",[
            "starttime"=>$starttime,
            "endtime"=>$endtime
        ]);
    }

    public function virusStatus(){
        return $this->makeRequest(ProxmoxApiClient::GET,"quarantine/virusstatus");
    }




}