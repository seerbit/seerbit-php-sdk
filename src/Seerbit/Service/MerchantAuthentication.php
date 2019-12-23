<?php
namespace Seerbit\Service;


class MerchantAuthentication extends MerchantService implements IAuthenticate
{

    private $result;
    public function __construct(\Seerbit\Client $client)
    {
        parent::__construct($client);

    }

    public function Auth(){
        $client = $this->getClient();
        $config = $client->getConfig();
        $params = ['email' => $config->getUserName(),"password" => $config->getPassword()];
        $this->result = $this->postRequest("merchants/api/v1/auth/login",$params);
        return $this;
    }

    public function getToken(){
        if ($this->result){
            return $this->result['payload']['token'];
        }
        return null;
    }

    public function toArray(){
        return $this->result;
    }

    public function toJson(){
        return json_encode($this->result);
    }

}