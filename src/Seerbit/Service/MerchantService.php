<?php

namespace Seerbit\Service;

use \Seerbit\HttpClient\CurlClient;
use Seerbit\Service\IService;

class MerchantService implements IService
{

    private $client;

    private $httpClient;

    protected $requiresToken = false;

    public function __construct(\Seerbit\Client $client)
    {

        $msg = null;
        $this->httpClient = new CurlClient();

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

    protected function putRequest($endpoint,$params, $token = null){
        return $this->httpClient->PUT(
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