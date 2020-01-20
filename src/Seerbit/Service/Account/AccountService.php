<?php


namespace Seerbit\Service\Account;

use Seerbit\Client;
use Seerbit\Service\ITransformable;
use Seerbit\Service\TransactionService;

class AccountService extends TransactionService implements ITransformable
{
    private $token;
    private $result;

    public function __construct(Client $client, $token)
    {
        parent::__construct($client);
        $this->token = $token;

    }

    public function Authorize($payload){
        parent::setRequiresToken(true);
        $payload['public_key'] = $this->getClient()->getPublicKey();
        $this->result = $this->postRequest("sbt/api/account/v1/initiate/transaction",$payload, $this->token);
        return $this;
    }

    public function Validate($payload){
        $this->requiresToken = true;
        $this->result = $this->postRequest("sbt/api/account/v1/validate/transaction",$payload, $this->token);
        return $this;
    }

    public function toArray(){
        return $this->result;
    }

    public function toJson(){
        return json_encode($this->result);
    }

}