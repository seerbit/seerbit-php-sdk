<?php
namespace Seerbit\Service;

use Seerbit\Service;

class Authenticate extends TransactionService implements IAuthenticate
{

    private $result;
    public function __construct(\Seerbit\Client $client)
    {
        parent::__construct($client);

    }

    public function Auth(){
        $client = $this->getClient();
        $config = $client->getConfig();
        $params = ['clientId' => $config->getPublicKey(),"clientSecret" => $config->getClientSecret()];
        $this->result = $this->postRequest("sbt/api/v1/auth",$params);
        return $this;
    }


    public function toArray(){
        return $this->result;
    }

    public function toJson(){
        return json_encode($this->result);
    }


    public function getToken(){
        if ($this->result){
            return $this->result['access_token'];
        }
        return null;
    }
}