<?php

namespace Seerbit\Service;

use \Seerbit\HttpClient\CurlClient;
use Seerbit\SeerbitException;

class TransactionService implements IService
{

    protected \Seerbit\Client $client;

    private CurlClient $httpClient;

    protected bool $requiresToken = false;

    /**
     * @throws SeerbitException
     */
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

    public function getClient(): \Seerbit\Client
    {
        return $this->client;
    }

    /**
     * @throws SeerbitException
     */
    protected function postRequest($path, $params): array
    {
            return $this->httpClient->POST(
                $this,
                $this->client->getConfig()->get('endpoint') . $path,
                $params,
                $this->client->getToken(),
                $this->client->getAuthType()
            );
    }

    /**
     * @throws SeerbitException
     */
    protected function getRequest($path): array
    {
            return $this->httpClient->GET(
                $this,
                $this->client->getConfig()->get('endpoint') . $path,
                $this->client->getToken(),
                $this->client->getAuthType()
                );
    }

    /**
     * @throws SeerbitException
     */
    protected function putRequest($path, $params): array
    {
        return $this->httpClient->POST(
            $this,
            $this->client->getConfig()->get('endpoint') . $path,
            $params,
            $this->client->getToken(),
            $this->client->getAuthType()
        );
    }


    public function requiresToken(): bool
    {
        return $this->requiresToken;
    }

    public function setRequiresToken($val)
    {
      $this->requiresToken = $val;
    }
}