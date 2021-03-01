<?php


namespace FNDev\Proxmox\Api\Config;


class AdminConfig
{
    const ALLOWED_PARAMETERS=[
        "advfilter",
        "avast",
        "clamav",
        "custom_check",
        "custom_check_path",
        "dailyreport",
        "delete",
        "demo",
        "digest",
        "dkim_selector",
        "dkim_sign",
        "dkim_sign_all_mail",
        "email",
        "http_proxy",
        "statlifetime"
    ];
    private array $parameters;
    public function __set($name, $value)
    {
        if(false === array_search($name,self::ALLOWED_PARAMETERS)){
            throw new \InvalidArgumentException("only provided values are acceptable.check values in ALLOWED_PARAMETERS const");
        };
        $this->$name($value);
    }
    public function advfilter(bool $advfilter){
        $this->parameters["advfilter"]=$advfilter;
    }
    public function avast(bool $avast){
        $this->parameters['avast']=$avast;
    }
    public function clamav(bool $clamav){
        $this->parameters['avast']=$clamav;
    }
    public function custom_check($custom_check){
        $this->parameters['custom_check']=$custom_check;
    }
    public function custom_check_path(string $custom_check_path){
        $this->parameters['custom_check']=$custom_check_path;
    }
    public function dailyreport(bool $dailyreport){
        $this->parameters['dailyreport']=$dailyreport;
    }
    public function delete(string $delete){
        $this->parameters['delete']=$delete;
    }
    public function demo(bool $demo){
        $this->parameters['demo']=$demo;
    }
    public function digest(string $digest){
        $this->parameters['digest']=$digest;
    }
    public function dkim_selector(string $dkim_selector){
        $this->parameters['dkim_selector']=$dkim_selector;
    }
    public function dkim_sign(bool $dkim_sign){
        $this->parameters['dkim_sign']=$dkim_sign;
    }
    public function email(string $email){
        $this->parameters['email']=$email;
    }
    public function http_proxy($http_proxy){
        $this->parameters['http_proxy']=$http_proxy;
    }
    public function statlifetime(int $statlifetime){
        $this->parameters['statlifetime']=$statlifetime;
    }
    public function getParameters(){
        return $this->parameters;
    }
}