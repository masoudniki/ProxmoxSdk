<?php

namespace FNDev\Proxmox\Api\Statistics\Contact;

use FNDev\Proxmox\Api\AbstractClasses\AddHttpClient;
use FNDev\Proxmox\ProxmoxApiClient;
use FNDev\Proxmox\Traits\MakeRequest;

class Contact extends AddHttpClient
{
    use MakeRequest;

    /**
     * @param string $email sender email address
     * @param int $day Day of month. Get statistics for a single day.
     * @param int $endtime
     * @param string $filter
     * @param int $month
     * @param int $orderby
     * @param int $starttime
     * @param int $year
     * @return mixed
     */
    public function contact(string $email,$day=null,$endtime=null,$filter=null,$month=null,$orderby=null,$starttime=null,$year=null){
        return $this->makeRequest(ProxmoxApiClient::GET,"statistics/contact/$email",[
            "day"=>$day,
            "endtime"=>$endtime,
            "filter"=>$filter,
            "month"=>$month,
            "orderby"=>$orderby,
            "starttime"=>$starttime,
            "year"=>$year
        ]);
    }

}