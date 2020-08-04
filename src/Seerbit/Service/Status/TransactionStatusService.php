<?php


namespace Seerbit\Service\Status;

use Seerbit\Client;
use Seerbit\Service\ITransformable;
use Seerbit\Service\TransactionService;

class TransactionStatusService extends TransactionService implements ITransformable
{

    private $result;

    public function __construct(Client $client)
    {
        parent::__construct($client);
    }

    public function ValidateTransactionStatus($transaction_reference){
        $this->setRequiresToken(true);
        $this->result = $this->getRequest("payments/query/".$transaction_reference);
        return $this;
    }

    public function ValidateSubscriptionStatus($billingId){
        $this->setRequiresToken(true);
        $this->result = $this->getRequest("recurring/billingId/".$billingId);
        return $this;
    }

    public function toArray(){
        return $this->result;
    }

    public function toJson(){
        return json_encode($this->result);
    }
}