<?php


namespace Seerbit\Service\Dispute;

use Seerbit\Client;
use Seerbit\Service\MerchantService;
use Seerbit\Service\ITransformable;


class DisputeService extends MerchantService implements ITransformable
{
    private $token;
    private $result;

    public function __construct(Client $client, $token)
    {
        parent::__construct($client);
        $this->token = $token;

    }

    public function all($business_id, $from = 0, $to = 10){
        $this->requiresToken = true;
        $this->result = $this->getRequest("merchants/api/v1/user/{$business_id}/disputes/?page={$from}&size={$to}", $this->token);
        return $this;
    }

    public function find($business_id,$dispute_id, $from = 0, $to = 10){
        $this->requiresToken = true;
        $this->result = $this->getRequest("merchants/api/v1/user/{$business_id}/disputes/{$dispute_id}", $this->token);
        return $this;
    }

    public function add($business_id,$payload){
        $this->requiresToken = true;
        $this->result = $this->postRequest("merchants/api/v1/user/{$business_id}/disputes",$payload, $this->token);
        return $this;
    }

    public function close($business_id,$dispute_id,$payload){
        $this->requiresToken = true;
        $this->result = $this->putRequest("merchants/api/v1/user/{$business_id}/disputes/{$dispute_id}/close",$payload, $this->token);
        return $this;
    }

    public function update($business_id,$payload){
        $this->requiresToken = true;
        $this->result = $this->putRequest("merchants/api/v1/user/{$business_id}/disputes",$payload, $this->token);
        return $this;
    }


    public function toArray(){
        return $this->result;
    }

    public function toJson(){
        return json_encode($this->result);
    }

}