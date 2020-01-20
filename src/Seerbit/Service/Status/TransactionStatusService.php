<?php


namespace Seerbit\Service\Status;

use Seerbit\Client;
use Seerbit\Service\ITransformable;
use Seerbit\Service\TransactionService;

class TransactionStatusService extends TransactionService implements ITransformable
{

    private $token;
    private $result;

    public function __construct(Client $client, $token)
    {
        parent::__construct($client);
        $this->token = $token;

    }


    public function ValidateStatus($transaction_reference){
        $this->setRequiresToken(true);
        $this->result = $this->getRequest("sbt/api/card/v1/get/transaction/status/".$transaction_reference, $this->token);
        return $this;
    }

    public function toArray(){
        return $this->result;
    }

    public function toJson(){
        return json_encode($this->result);
    }
}