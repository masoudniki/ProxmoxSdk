<?php

namespace FNDev\Proxmox\Api\Statistics;
use FNDev\Proxmox\Api\AbstractClasses\AddHttpClient;
use FNDev\Proxmox\Api\Statistics\Contact\Contact;
use FNDev\Proxmox\Api\Statistics\Receiver\Receiver;
use FNDev\Proxmox\Api\Statistics\Sender\Sender;
use FNDev\Proxmox\ProxmoxApiClient;
use FNDev\Proxmox\Traits\MakeRequest;

class Statistics extends AddHttpClient
{
    use MakeRequest;
    public function sender(){
        return new Sender($this->httpClient);
    }
    public function receiver(){
        return new Receiver($this->httpClient);
    }
    public function contact(){
        return new Contact($this->httpClient);
    }

    public function domains($day=null,$endtime=null,$month=null,$starttime=null,$year=null){
        return $this->makeRequest(ProxmoxApiClient::GET,"statistics/domains",[
            "day"=>$day,
            "endtime"=>$endtime,
            "month"=>$month,
            "starttime"=>$starttime,
            "year"=>$year
        ]);
    }
    public function mail($starttime=null,$endtime=null,$month=null,$year=null,$day=null){
        return $this->makeRequest(ProxmoxApiClient::GET,"statistics/mail",[
            "day"=>$day,
            "endtime"=>$endtime,
            "month"=>$month,
            "starttime"=>$starttime,
            "year"=>$year
        ]);
    }
    public function mailcount($starttime=null,$endtime=null,$timespan=null,$day=null,$month=null,$year=null){
        return $this->makeRequest(ProxmoxApiClient::GET,"statistics/mailcount",[
            "day"=>$day,
            "endtime"=>$endtime,
            "month"=>$month,
            "starttime"=>$starttime,
            "timespan"=>$timespan,
            "year"=>$year
        ]);
    }
    public function maildistribution($day=null,$endtime=null,$month=null,$starttime=null,$timespan=null,$year=null){
        return $this->makeRequest(ProxmoxApiClient::GET,"statistics/maildistribution",[
            "day"=>$day,
            "endtime"=>$endtime,
            "month"=>$month,
            "starttime"=>$starttime,
            "timespan"=>$timespan,
            "year"=>$year
        ]);
    }

    public function recent($hours=null,$timespan=null){
        return $this->makeRequest(ProxmoxApiClient::GET,"statistics/recent",[
            "hours"=>$hours,
            "timespan"=>$timespan
        ]);
    }
    public function recentreceivers($hours,$limit){
        return $this->makeRequest(ProxmoxApiClient::GET,"statistics/recentreceivers",[
            "hours"=>$hours,
            "limit"=>$limit
        ]);
    }
    public function rejectcount($day=null,$endtime=null,$month=null,$starttime=null,$timespan=null,$year=null){
        return $this->makeRequest(ProxmoxApiClient::GET,"statistics/rejectcount",[
            "day"=>$day,
            "endtime"=>$endtime,
            "month"=>$month,
            "starttime"=>$starttime,
            "timespan"=>$timespan,
            "year"=>$year
        ]);


    }
    public function spamScores($day=null,$endtime=null,$month=null,$starttime=null,$timespan=null,$year=null){
        return $this->makeRequest(ProxmoxApiClient::GET,"statistics/spamscores",[
            "day"=>$day,
            "endtime"=>$endtime,
            "month"=>$month,
            "starttime"=>$starttime,
            "year"=>$year
        ]);
    }

    public function virus($day=null,$endtime=null,$month=null,$starttime=null,$timespan=null,$year=null){
        $this->makeRequest(ProxmoxApiClient::GET,"statistics/virus",[
                "day"=>$day,
                "endtime"=>$endtime,
                "month"=>$month,
                "starttime"=>$starttime,
                "year"=>$year
        ]);

    }



}