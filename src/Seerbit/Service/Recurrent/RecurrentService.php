<?php


namespace Seerbit\Service\Recurrent;

use Seerbit\Client;
use Seerbit\Service\ITransformable;
use Seerbit\Service\TransactionService;
use Seerbit\Service\Validators\RecurrentValidator;

class RecurrentService extends TransactionService implements ITransformable
{

    private $result;

    public function __construct(Client $client)
    {
        parent::__construct($client);
    }

    public function CreateSubscription($payload){
        RecurrentValidator::Create($payload);
        $this->setRequiresToken(true);
        $payload['publicKey'] = $this->getClient()->getPublicKey();
        $this->result = $this->postRequest("recurring/subscribes",$payload);
        return $this;
    }

    public function ChargeSubscription($payload){
        RecurrentValidator::Charge($payload);
        $this->setRequiresToken(true);
        $payload['publicKey'] = $this->getClient()->getPublicKey();
        $this->result = $this->postRequest("recurring/charge",$payload);
        return $this;
    }

    public function UpdateSubscription($payload){
        RecurrentValidator::Update($payload);
        $this->setRequiresToken(true);
        $payload['publicKey'] = $this->getClient()->getPublicKey();
        $this->result = $this->putRequest("recurring/updates",$payload);
        return $this;
    }

    public function GetCustomerSubscription($customerId){
        RecurrentValidator::Get($customerId);
        $this->setRequiresToken(true);
        $payload['publicKey'] = $this->getClient()->getPublicKey();
        $this->result = $this->getRequest("recurring/customerId/".$customerId);
        return $this;
    }

    public function GetMerchantSubscription($customerId){
        $this->setRequiresToken(true);
        $payload['publicKey'] = $this->getClient()->getPublicKey();
        $this->result = $this->getRequest("recurring/publicKey/".$this->getClient()->getPublicKey());
        return $this;
    }

    public function toArray(){
        return $this->result;
    }

    public function toJson(){
        return json_encode($this->result);
    }
}