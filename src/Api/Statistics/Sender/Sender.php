<?php

namespace FNDev\Proxmox\Api\Statistics\Sender;

use FNDev\Proxmox\Api\AbstractClasses\AddHttpClient;
use FNDev\Proxmox\ProxmoxApiClient;
use FNDev\Proxmox\Traits\MakeRequest;

class Sender extends AddHttpClient
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
    public function sender(string $email,$starttime=null,$endtime=null,$orderby=null,$filter=null,$day=null,$month=null,$year=null){
        $email=isset($email) ? "/".ltrim($email,"/"): null;
        return $this->makeRequest(ProxmoxApiClient::GET,"statistics/sender$email",[
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