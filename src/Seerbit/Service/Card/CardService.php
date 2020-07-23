<?php


namespace Seerbit\Service\Card;

use Seerbit\Client;
use Seerbit\Service\ITransformable;
use Seerbit\Service\TransactionService;
use Seerbit\Service\Validators\CardValidator;

class CardService extends TransactionService implements ITransformable
{

    private $token;
    private $result;
    private $_client;

    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->_client = $client;

    }

    public function Authorize($payload){
        CardValidator::Authorize($payload);
        $this->setRequiresToken(true);
        $payload['publicKey'] = $this->getClient()->getPublicKey();
        $this->result = $this->postRequest("payments/authorise",$payload);
        return $this;
    }

    public function Capture($payload){
        $this->setRequiresToken(true);
        $payload['publicKey'] = $this->getClient()->getPublicKey();
        $this->result = $this->postRequest("payments/capture",$payload);
        return $this;
    }

    public function Cancel($payload){
        $this->setRequiresToken(true);
        $payload['publicKey'] = $this->getClient()->getPublicKey();
        $this->result = $this->postRequest("payments/cancel",$payload);
        return $this;
    }

    public function Refund($payload){
        $this->setRequiresToken(true);
        $payload['publicKey'] = $this->getClient()->getPublicKey();
        $this->result = $this->postRequest("payments/refund",$payload);
        return $this;
    }

    public function CaptureNoAuth($payload){
        $this->setRequiresToken(true);
        $payload['publicKey'] = $this->getClient()->getPublicKey();
        $this->result = $this->postRequest("payments/sale",$payload);
        return $this;
    }

    public function ChargeNon3D($payload){
        $this->setRequiresToken(true);
        $payload['publicKey'] = $this->getClient()->getPublicKey();
        $this->result = $this->postRequest("payments/charge",$payload);
        return $this;
    }

    public function Charge3D($payload){
        $this->setRequiresToken(true);
        $payload['publicKey'] = $this->getClient()->getPublicKey();
        $this->result = $this->postRequest("payments/initiates",$payload);
        return $this;
    }

    public function Charge3DS($payload){
        $this->setRequiresToken(true);
        $payload['publicKey'] = $this->getClient()->getPublicKey();
        $this->result = $this->postRequest("payments/initiates",$payload);
        return $this;
    }

    public function ChargeAccount($payload){
        $this->setRequiresToken(true);
        $payload['publicKey'] = $this->getClient()->getPublicKey();
        $payload['channelType'] = "BANK_ACCOUNT";
        $this->result = $this->postRequest("payments/initiates",$payload);
        return $this;
    }

    public function ValidateOtp($payload){
        $this->setRequiresToken(true);
        $payload['publicKey'] = $this->getClient()->getPublicKey();
        $this->result = $this->postRequest("payments/otp",$payload, $this->token);
        return $this;
    }

    public function toArray(){
        return $this->result;
    }

    public function toJson(){
        return json_encode($this->result);
    }
}