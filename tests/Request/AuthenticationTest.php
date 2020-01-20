<?php


namespace Seerbit\Request;


use PHPUnit\Framework\TestCase;
use Seerbit\Client;
use Seerbit\Service\Authenticate;
use Seerbit\Service\MerchantAuthentication;

class AuthenticationTest extends TestCase
{

    public function testTransactionServiceAuth(){
        $client = new Client();
        $client->setPublicKey("SBTESTPUBK_PjQ5dFOi522L383MlsQYUMAe6cZYviTF");
        $client->setPrivateKey("SBTESTSECK_9CDyHxbubCHnqJba5iiIytD5TLyySiHNvBY1UhPX");

        $client->setEnvironment(\Seerbit\Environment::LIVE);

        //Instantiate Authentication Service
        $authService = new Authenticate($client);

        //Get Auth
        $auth = $authService->Auth();

        //Get Auth Data
        $auth_data= $auth->toArray();

        //Test has token key
        $this->assertArrayHasKey("access_token",$auth_data);

        //Get Auth Token
        $auth_token= $auth->getToken();

        $this->assertNotNull($auth_token);
    }

    public function testMerchantServiceAuth(){
        $client = new Client();
        $client->setEnvironment(\Seerbit\Environment::LIVE);
        $client->setUsername("victorighalo@gmail.com");
        $client->setPassword("WISdom@1");

        //Instantiate Authentication Service
        $authService = new MerchantAuthentication($client);

        //Get Auth
        $auth = $authService->Auth();

        //Get Auth Data
        $auth_data= $auth->toArray();

        //Test has token key
        $this->assertArrayHasKey("token",$auth_data);

        //Get Auth Token
        $auth_token= $auth->getToken();

        $this->assertNotNull($auth_token);
    }
}