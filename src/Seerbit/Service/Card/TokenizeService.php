<?php


namespace Seerbit\Service\Card;

use Seerbit\Client;
use Seerbit\Service\ITransformable;
use Seerbit\Service\TransactionService;
use Seerbit\Service\Validators\CardValidator;

class TokenizeService extends TransactionService implements ITransformable, TokenizeServiceContract
{
    use \Seerbit\Service\Transformable;

    private $result;
    private $_client;

    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->_client = $client;

    }

    public function CreateToken(array $payload){
        CardValidator::AuthorizeOnetime($payload);
        $this->setRequiresToken(true);
        $payload['publicKey'] = $this->getClient()->getPublicKey();
        $this->result = $this->postRequest("payments/create-token",$payload);
        return $this;
    }

    public function ValidateOtp(array $payload){
        $this->setRequiresToken(true);
        $transformed_payload = ['transaction' => $payload, 'publickey' => $this->getClient()->getPublicKey()];
        $this->result = $this->postRequest("payments/otp",$transformed_payload);
        return $this;
    }

    public function GetToken(string $reference){
        $this->setRequiresToken(true);
        $payload['publicKey'] = $this->getClient()->getPublicKey();
        $this->result = $this->getRequest("payments/query/".$reference);
        return $this;
    }

    public function ChargeToken(array $payload){
        $this->setRequiresToken(true);
        $payload['publicKey'] = $this->getClient()->getPublicKey();
        $this->result = $this->postRequest("payments/charge-token",$payload);
        return $this;
    }

    public function ChargeTokenBulk(array $payload){
        $this->setRequiresToken(true);
        $this->result = $this->postRequest("payments/bulk-tokenize-charge",$payload);
        return $this;
    }

}