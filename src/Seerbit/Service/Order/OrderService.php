<?php


namespace Seerbit\Service\Order;

use Seerbit\Client;
use Seerbit\Service\ITransformable;
use Seerbit\Service\TransactionService;
use Seerbit\Service\Validators\OrderValidator;
class OrderService extends TransactionService implements ITransformable
{

    private $result;
    private $_client;

    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->_client = $client;
    }

    public function Create($payload){
        OrderValidator::Create($payload);
        $this->setRequiresToken(true);
        $payload['publicKey'] = $this->getClient()->getPublicKey();
        $this->result = $this->postRequest("payments/order",$payload);
        return $this;
    }

    public function toArray(){
        return $this->result;
    }

    public function toJson(){
        return json_encode($this->result);
    }
}