<?php

namespace Seerbit\Service\Mobile;

use Seerbit\Client;
use Seerbit\Service\ITransformable;
use Seerbit\Service\TransactionService;

class MobileService extends TransactionService implements ITransformable
{

    private $result;

    public function __construct(Client $client)
    {
        parent::__construct($client);
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
        $this->result = $this->getRequest("networks");
        return $this;
    }

    public function toArray(){
        return $this->result;
    }

    public function toJson(){
        return json_encode($this->result);
    }
}