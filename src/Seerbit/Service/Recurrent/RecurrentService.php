<?php


namespace Seerbit\Service\Recurrent;

use Seerbit\Client;
use Seerbit\Service\ITransformable;
use Seerbit\Service\TransactionService;

class RecurrentService extends TransactionService implements ITransformable
{

    private $result;

    public function __construct(Client $client)
    {
        parent::__construct($client);
    }

    public function CreateSubscription($payload){
        $this->setRequiresToken(true);
        $payload['publicKey'] = $this->getClient()->getPublicKey();
        $this->result = $this->postRequest("recurring/subscribes",$payload);
        return $this;
    }

    public function toArray(){
        return $this->result;
    }

    public function toJson(){
        return json_encode($this->result);
    }
}