<?php


namespace FNDev\Proxmox\Api\Access;


use http\Exception\InvalidArgumentException;

class TicketParameters
{
    const ALLOWED_PARAMETERS=[
        "password",
        "username",
        "otp",
        "path",
        "realm"
    ];
    const REALM=[
        "pam",
        "pmg",
        "quarantine"
    ];
    private array $parameters=[];

    public function __construct($password,$username)
    {
        $this->parameters['username']=$username;
        $this->parameters['password']=$password;
    }


    public function __set($name, $value)
    {
        if(false===array_search($name,self::ALLOWED_PARAMETERS)){
            throw new \InvalidArgumentException("parameter $name is not a valid parameter");
        };
        $this->$name($value);
    }

    private function otp($otp){
        $this->parameters["otp"]=$otp;
    }

    private function path($path){
        $this->parameters["path"]=$path;
    }
    private function realm($realm){
        if(false===array_search($realm,self::REALM)){
            throw new InvalidArgumentException("only provided values are acceptable.check values in ROLES const");
        }
        $this->parameters["realm"]=$realm;
    }
    public function getParameters(){
        return $this->parameters;
    }




}