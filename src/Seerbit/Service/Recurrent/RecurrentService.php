<?php


namespace Seerbit\Service\Recurrent;

use Seerbit\Client;
use Seerbit\Service\ITransformable;
use Seerbit\Service\TransactionService;
use Seerbit\Service\Validators\RecurrentValidator;

class RecurrentService extends TransactionService implements ITransformable
{

    private $result;
    private Client $_client;

    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->_client = $client;
    }

    public function CreateSubscription($payload): static
    {
        RecurrentValidator::Create($payload);
        $this->setRequiresToken(true);
        $payload['publicKey'] = $this->getClient()->getPublicKey();
        $this->result = $this->postRequest("recurring/subscribes",$payload);
        return $this;
    }

    public function ChargeSubscription($payload): static
    {
        RecurrentValidator::Charge($payload);
        $this->setRequiresToken(true);
        $payload['publicKey'] = $this->getClient()->getPublicKey();
        $this->_client->setAuthType(\Seerbit\AuthType::BASIC);
        $this->result = $this->postRequest("recurring/charge",$payload);
        return $this;
    }

    public function UpdateSubscription($payload): static
    {
        RecurrentValidator::Update($payload);
        $this->setRequiresToken(true);
        $payload['publicKey'] = $this->getClient()->getPublicKey();
        $this->_client->setAuthType(\Seerbit\AuthType::BASIC);
        $this->result = $this->putRequest("recurring/updates",$payload);
        return $this;
    }

    public function GetCustomerSubscription($customerId): static
    {
        RecurrentValidator::Get($customerId);
        $this->setRequiresToken(true);
        $this->_client->setAuthType(\Seerbit\AuthType::BASIC);
        $this->result = $this->getRequest("recurring/customerId/".$customerId);
        return $this;
    }

    public function GetMerchantSubscription(): static
    {
        $this->setRequiresToken(true);
        $this->_client->setAuthType(\Seerbit\AuthType::BASIC);
        $this->result = $this->getRequest("recurring/publicKey/".$this->getClient()->getPublicKey());
        return $this;
    }

    public function toArray(): array{
        return $this->result;
    }

    public function toJson(): bool|string
    {
        return json_encode($this->result);
    }
}