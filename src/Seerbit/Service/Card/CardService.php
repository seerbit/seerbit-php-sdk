<?php


namespace Seerbit\Service\Card;

use Seerbit\Client;
use Seerbit\Service\ITransformable;
use Seerbit\Service\TransactionService;

class CardService extends TransactionService implements ITransformable
{

    private $token;
    private $result;

    public function __construct(Client $client, $token)
    {
        parent::__construct($client);
        $this->token = $token;

    }

    public function Authorize($payload){
        $this->setRequiresToken(true);
        $payload['public_key'] = $this->getClient()->getPublicKey();
        $this->result = $this->postRequest("sbt/api/card/v1/init/transaction",$payload, $this->token);
        return $this;
    }

    public function ValidateOtp($payload){
        $this->setRequiresToken(true);
        $this->result = $this->postRequest("sbt/api/card/v1/validate/otp",$payload, $this->token);
        return $this;
    }

    public function toArray(){
        return $this->result;
    }

    public function toJson(){
        return json_encode($this->result);
    }
}