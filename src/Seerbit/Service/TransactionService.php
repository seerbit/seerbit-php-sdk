<?php

namespace Seerbit\Service;


use \Seerbit\HttpClient\CurlClient;
use Seerbit\Service\IAuthenticate;
use Seerbit\Service\IService;

class TransactionService implements IService
{

    private $client;

    private $httpClient;

    protected $requiresToken = false;

    public function __construct(\Seerbit\Client $client)
    {

        $msg = null;
        $this->httpClient = new CurlClient();


        if (!$client->getConfig()->get('environment')) {
            // throw exception
            $msg = "The Client does not have a correct environment, use " . \Seerbit\Environment::PILOT . ' or ' . \Seerbit\Environment::LIVE;
            throw new \Seerbit\SeerbitException($msg);
        }


        if (!$client->getConfig()->get('publicKey')) {
            // throw exception
            $msg = "The client does not have a merchant public key. Set a public key using the Client.";
            throw new \Seerbit\SeerbitException($msg);
        }

        if (!$client->getConfig()->get('privateKey')) {
            // throw exception
            $msg = "The client does not have a merchant private key. Set a private key using the Client.";
            throw new \Seerbit\SeerbitException($msg);
        }

        $this->client = $client;
    }

    public function getClient()
    {
        return $this->client;
    }

    protected function postRequest($endpoint,$params, $token = null){
        return $this->httpClient->POST(
            $this,
            $this->client->getConfig()->get('endpoint'). $endpoint,
            $params,
            $token);
    }

    protected function getRequest($endpoint, $token = null){

        return $this->httpClient->GET(
            $this,
            $this->client->getConfig()->get('endpoint'). $endpoint,
            $token);
    }


    public function requiresToken()
    {
        return $this->requiresToken;
    }

    public function setRequiresToken($val)
    {
      $this->requiresToken = $val;
    }
}