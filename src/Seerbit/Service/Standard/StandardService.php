<?php


namespace Seerbit\Service\Standard;

use Seerbit\Client;
use Seerbit\Service\ITransformable;
use Seerbit\Service\TransactionService;
use Seerbit\Service\Validators\StandardValidator;

class StandardService extends TransactionService implements ITransformable
{

    private $result;
    private $_client;

    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->_client = $client;

    }

    public function Initialize($payload){
        StandardValidator::Initialize($payload);
        $this->setRequiresToken(true);
        $payload['publicKey'] = $this->getClient()->getPublicKey();
        $hash_string_build = "";
        foreach ($payload as $key => $value){
            $hash_string_build .= $key."=".$value."&";
        }
        $string_to_hash = rtrim($hash_string_build, "&").$this->getClient()->getSecretKey();
        $hash = hash('sha256', $string_to_hash);

        $payload['hash'] = $hash;
        $payload["hashType"] = "sha256";

        $this->result = $this->postRequest("payments",$payload);
        return $this;
    }


    public function toArray(){
        return $this->result;
    }

    public function toJson(){
        return json_encode($this->result);
    }
}