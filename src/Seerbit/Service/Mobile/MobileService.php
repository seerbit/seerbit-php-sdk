<?php

namespace Seerbit\Service\Mobile;

use Seerbit\Client;
use Seerbit\Service\ITransformable;
use Seerbit\Service\TransactionService;

class MobileService extends TransactionService implements ITransformable
{

    private $result;
    private $token;

    public function __construct(Client $client,$token)
    {
        parent::__construct($client);
        $this->token = $token;
    }

    public function Authorize($payload){
        $this->setRequiresToken(true);
        $payload['publicKey'] = $this->getClient()->getPublicKey();
        $this->result = $this->postRequest("payments/initiates",$payload);
        return $this;
    }

    public function Networks(){
        $this->setRequiresToken(true);
        $payload['publicKey'] = $this->getClient()->getPublicKey();
        $this->result = $this->getRequest("networks",$this->token);
        return $this;
    }

    public function toArray(){
        return $this->result;
    }

    public function toJson(){
        return json_encode($this->result);
    }
}