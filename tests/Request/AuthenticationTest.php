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
        $client->setPublicKey("SBPUBK_OMX6ZNRZPLIHQ9Y0ZG6FCNR0EAYIGIAT");
        $client->setPrivateKey("SBSECK_P18STKMKODQF9ZUYMSPNHVTU9JMWJRPKZO1HJM5R");

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
        $client->setUsername("centricgateway@gmail.com ");
        $client->setPassword("8b432b4932f349518f6a82ae326ada10");

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