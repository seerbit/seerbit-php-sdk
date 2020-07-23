<?php


namespace Seerbit\Service\Account;

use Seerbit\Client;
use Seerbit\Service\ITransformable;
use Seerbit\Service\TransactionService;
use Seerbit\Service\Validators\AccountValidator;

class AccountService extends TransactionService implements ITransformable
{
    private $result;

    public function __construct(Client $client)
    {
        parent::__construct($client);
    }

    public function Authorize($payload){
        parent::setRequiresToken(true);
        AccountValidator::Authorize($payload);
        $payload['publicKey'] = $this->getClient()->getPublicKey();
        $payload['paymentType'] = "ACCOUNT";

        $this->result = $this->postRequest("payments/initiates",$payload);
        return $this;
    }

    public function Validate($payload){
        $this->requiresToken = true;
        AccountValidator::Validate($payload);
        $this->result = $this->postRequest("payments/validate",$payload);
        return $this;
    }

    public function toArray(){
        return $this->result;
    }

    public function toJson(){
        return json_encode($this->result);
    }

}