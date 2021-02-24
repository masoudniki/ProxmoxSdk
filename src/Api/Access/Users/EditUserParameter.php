<?php


namespace FNDev\Proxmox\Api\Access\Users;


class EditUserParameter
{
    private array $parameters=[];
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
    const ROLES=[
        "root",
        "admin",
        "helpdesk",
        "qmanager",
        "audit"
    ];
    public function __set($name, $value)
    {
        if(false === array_search($name,self::ALLOWED_PARAMETERS)){
            throw new \InvalidArgumentException("parameter $name is not a valid parameter");
        };
        $this->$name($value);
    }
    private function comment(string $value){
        $this->parameters["comment"]=$value;
    }
    private function crypt_pass($password)
    {
        $this->parameters["crypt_pass"] = crypt($password);
    }
    public function password(string $password){
        $this->parameters["password"]=$password;
    }
    private function delete(bool $state){
        $this->parameters["delete"]=(int)$state;
    }
    private function email(string $email){
        if(filter_var($email,FILTER_VALIDATE_EMAIL)){
            $this->parameters["email"]=$email;
        }
        throw new \InvalidArgumentException("invalid email format");

    }
    public function expire(int $value){
        $this->parameters["expire"]=$value;
    }
    public function role(string $role){
        if(false===array_search($role,self::ROLES)){
            return new \InvalidArgumentException("only provided values are acceptable.check values in ROLES const");
        }
        $this->parameters["role"]=$role;
    }
    public function getParameters(){
        return $this->parameters;
    }


}