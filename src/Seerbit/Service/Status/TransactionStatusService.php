<?php


namespace Seerbit\Service\Status;

use Seerbit\Client;
use Seerbit\SeerbitException;
use Seerbit\Service\ITransformable;
use Seerbit\Service\TransactionService;

class TransactionStatusService extends TransactionService implements ITransformable, TransactionStatusServiceContract
{

    private $result;

    /**
     * @throws SeerbitException
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
    }

    public function ValidateTransactionStatus(string $transaction_reference): static
    {
        $this->setRequiresToken(true);
        $this->client->setAuthType(\Seerbit\AuthType::BEARER);
        $this->result = $this->getRequest("payments/query/".$transaction_reference);
        return $this;
    }

    public function ValidateSubscriptionStatus(string $billingId): static
    {
        $this->setRequiresToken(true);
        $this->client->setAuthType(\Seerbit\AuthType::BEARER);
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