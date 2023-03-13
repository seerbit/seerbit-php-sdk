<?php

namespace Seerbit\Service;

use \Seerbit\HttpClient\CurlClient;

class TransactionService implements IService
{

    protected $client;

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

        if (!$client->getConfig()->get('secretKey')) {
            // throw exception
            $msg = "The client does not have a merchant secret key. Set a secret key using the Client.";
            throw new \Seerbit\SeerbitException($msg);
        }

        $this->client = $client;
    }

    public function getClient()
    {
        return $this->client;
    }

    protected function postRequest($endpoint,$path){
            return $this->httpClient->POST(
                $this,
                $this->client->getConfig()->get('endpoint') . $path,
                $params,
                $this->client->getToken(),
                $this->client->getAuthType()
            );
    }

    protected function getRequest($path){
            return $this->httpClient->GET(
                $this,
                $this->client->getConfig()->get('endpoint') . $path,
                $this->client->getToken(),
                $this->client->getAuthType()
                );
    }

    protected function putRequest($endpoint,$path){
        return $this->httpClient->POST(
            $this,
            $this->client->getConfig()->get('endpoint') . $path,
            $params,
            $this->client->getToken(),
            $this->client->getAuthType()
        );
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