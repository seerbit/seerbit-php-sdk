<?php


namespace Seerbit\Service\Card;

use Seerbit\Client;
use Seerbit\Service\ITransformable;
use Seerbit\Service\TransactionService;
use Seerbit\Service\Validators\CardValidator;

class CardService extends TransactionService implements ITransformable
{

    private $result;
    private $_client;

    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->_client = $client;

    }

    public function AuthorizeOneTime($payload){
        CardValidator::AuthorizeOnetime($payload);
        $this->setRequiresToken(false);
        $payload['publicKey'] = $this->getClient()->getPublicKey();
        $this->result = $this->postRequest("payments/authorise",$payload);
        return $this;
    }

    public function AuthorizeWithToken($payload){
        CardValidator::AuthorizeWithToken($payload);
        $this->setRequiresToken(false);
        $payload['publicKey'] = $this->getClient()->getPublicKey();
        $this->result = $this->postRequest("payments/authorise",$payload);
        return $this;
    }

    public function Capture($payload){
        CardValidator::Capture($payload);
        $this->setRequiresToken(false);
        $payload['publicKey'] = $this->getClient()->getPublicKey();
        $this->result = $this->postRequest("payments/capture",$payload);
        return $this;
    }

    public function Cancel($payload){
        CardValidator::Cancel($payload);
        $this->setRequiresToken(false);
        $payload['publicKey'] = $this->getClient()->getPublicKey();
        $this->result = $this->postRequest("payments/cancel",$payload);
        return $this;
    }

    public function Refund($payload){
        CardValidator::Refund($payload);
        $this->setRequiresToken(false);
        $payload['publicKey'] = $this->getClient()->getPublicKey();
        $this->result = $this->postRequest("payments/refund",$payload);
        return $this;
    }

    public function CaptureNoAuth($payload){
        CardValidator::CaptureNoAuth($payload);
        $this->setRequiresToken(true);
        $payload['publicKey'] = $this->getClient()->getPublicKey();
        $this->result = $this->postRequest("payments/sale",$payload);
        return $this;
    }

    public function ChargeNon3DOneTime($payload){
        CardValidator::ChargeNon3DOneTime($payload);
        $this->setRequiresToken(false);
        $payload['publicKey'] = $this->getClient()->getPublicKey();
        $this->result = $this->postRequest("payments/charge",$payload);
        return $this;
    }

    public function ChargeNon3DSWithToken($payload){
        CardValidator::ChargeNon3DSWithToken($payload);
        $this->setRequiresToken(false);
        $payload['publicKey'] = $this->getClient()->getPublicKey();
        $this->result = $this->postRequest("payments/charge",$payload);
        return $this;
    }

    public function ChargeWithoutPin($payload){
        CardValidator::Charge3D($payload);
        $this->setRequiresToken(true);
        $payload['publicKey'] = $this->getClient()->getPublicKey();
        $this->result = $this->postRequest("payments/initiates",$payload);
        return $this;
    }

    public function Tokenize($payload){
        CardValidator::Tokenize($payload);
        $this->setRequiresToken(false);
        $payload['publicKey'] = $this->getClient()->getPublicKey();
        $this->result = $this->postRequest("payments/tokenize",$payload);
        return $this;
    }

    public function ChargeWithPin($payload){
        CardValidator::ChargeNon3DS($payload);
        $this->setRequiresToken(true);
        $payload['publicKey'] = $this->getClient()->getPublicKey();
        $this->result = $this->postRequest("payments/initiates",$payload);
        return $this;
    }

    public function ValidateOtp($payload){
        CardValidator::Validate($payload);
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