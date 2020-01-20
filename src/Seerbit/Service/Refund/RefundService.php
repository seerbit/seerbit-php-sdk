<?php


namespace Seerbit\Service\Refund;

use Seerbit\Client;
use Seerbit\Service\MerchantService;
use Seerbit\Service\ITransformable;


class RefundService extends MerchantService implements ITransformable
{
    private $token;
    private $result;

    public function __construct(Client $client, $token)
    {
        parent::__construct($client);
        $this->token = $token;

    }

    public function Validate($trans_id){
        $this->requiresToken = true;
        $this->result = $this->getRequest("card/v1/get/transaction/status/".$trans_id, $this->token);
        return $this;
    }

    public function all($business_id, $from = 0, $to = 10){
        $this->requiresToken = true;
        $this->result = $this->getRequest("merchants/api/v1/user/{$business_id}/refunds/?page={$from}&size={$to}", $this->token);
        return $this;
    }

    public function find($business_id,$refund_ref, $from = 0, $to = 10){
        $this->requiresToken = true;
        $this->result = $this->getRequest("merchants/api/v1/user/{$business_id}/refunds/{$refund_ref}", $this->token);
        return $this;
    }

    public function refund($business_id,$payload){
        $this->requiresToken = true;
        $this->result = $this->postRequest("merchants/api/v1/user/{$business_id}/refunds",$payload, $this->token);
        return $this;
    }


    public function toArray(){
        return $this->result;
    }

    public function toJson(){
        return json_encode($this->result);
    }

}