<?php


namespace FNDev\Proxmox\Api\Access\Users;


class EditUserParameter
{
    private array $optionalParameters=[];
    const ALLOWED_PARAMETERS=[
        "comment",
        "crypt_pass",
        "delete",
        "email",
        "enable",
        "expire",
        "firstname",
        "lastname",
        "keys",
        "password",
        "role"
    ];
    public function __set($name, $value)
    {
        if(false === array_search($name,self::ALLOWED_PARAMETERS)){
            throw new \InvalidArgumentException("parameter $name is not a valid parameter");
        };
    }
    private function comment(string $value){
        $this->optionalParameters["comment"]=$value;
    }
    private function crypt_pass($password){
        $this->optionalParameters["crypt_pass"]=crypt($password);
    }
    private function delete(bool $state){
        $this->optionalParameters["delete"]=(int)$state;
    }
    private function email(string $email){
        if(filter_var($email,FILTER_VALIDATE_EMAIL)){
            $this->optionalParameters["email"]=$email;
        }
        throw new \InvalidArgumentException("invalid email format");

    }
    public function expire(int $value){

    }


}