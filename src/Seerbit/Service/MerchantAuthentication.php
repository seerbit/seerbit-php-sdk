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
            if (array_key_exists('payload',$this->result )){
                if (array_key_exists('token',$this->result['payload'] )){
                    return $this->result['payload']['token'];
                }else{
                    return null;
                }
            }else{
                return null;
            }
        }else{
            return null;
        }
    }

    public function toArray(){
        if ($this->result){
            if (array_key_exists('payload',$this->result )){
                return $this->result['payload'];
            }else{
                return null;
            }
        }else{
            return null;
        }
    }

    public function toJson(){
        if ($this->result){
            if (array_key_exists('payload',$this->result )){
                return json_encode($this->result['payload']);
            }else{
                return null;
            }
        }else{
            return null;
        }
    }

}