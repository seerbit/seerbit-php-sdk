<?php

namespace Seerbit\Service\Resource;

use Seerbit\Client;
use Seerbit\Service\ITransformable;
use Seerbit\Service\TransactionService;

class ResourceService extends TransactionService implements ITransformable
{

    private $result;
    private $_client;

    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->_client = $client;

    }

    public function GetBankList(){
        $this->setRequiresToken(false);
        $this->client->setAuthType(\Seerbit\AuthType::BEARER);
        $this->result = $this->getRequest("banks/merchant/".$this->getClient()->getPublicKey());
        return $this;
    }

    public function toArray(){
        return $this->result;
    }

    public function toJson(){
        return json_encode($this->result);
    }
}