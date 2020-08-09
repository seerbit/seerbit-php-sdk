<?php

namespace Seerbit\Request;


use PHPUnit\Framework\TestCase;
use Seerbit\Client;
use Seerbit\Service\Mobile\MobileService;

class MomoTest extends TestCase
{

    public function testMomoNetworks(){
        $token = "1KWLzpZkWaoXO9AN4qweKwqLjGcQSNt8kjeVjsdTG4lPlwg6sTvpVAay2RA7hoCEzHPkIQa+MNfDepx4VBr5JMgLb5Q5anq9XoN2pXU850bumqBWFVw1T1ZW5w8N+Sq/";
        //Instantiate SeerBit Client
        $client = new Client();
        $client->setToken($token);
        $client->setLoggerPath(dirname(__FILE__));
        //Configure SeerBit Client
        $client->setEnvironment(\Seerbit\Environment::LIVE);

        //SETUP CREDENTIALS
        $client->setPublicKey("SBTESTPUBK_p8GqvFSFNCBahSJinczKd9aIPoRUZfda");
        $client->setSecretKey("SBTESTSECK_kFgKytQK1KSvbR616rUMqNYOUedK3Btm5igZgxaZ");


        //Instantiate Mobile Money Service
        $service = New MobileService($client);

        $result = $service->Networks();

        $this->assertArrayHasKey("httpStatus",$result->toArray());

        $this->assertEquals("200",$result->toArray()["httpStatus"]);
    }

    public function testMomoAuthorize(){
        $token = "1KWLzpZkWaoXO9AN4qweKwqLjGcQSNt8kjeVjsdTG4lPlwg6sTvpVAay2RA7hoCEzHPkIQa+MNfDepx4VBr5JMgLb5Q5anq9XoN2pXU850bumqBWFVw1T1ZW5w8N+Sq/";
        //Instantiate SeerBit Client
        $client = new Client();
        $client->setToken($token);
        //Configure SeerBit Client
        $client->setEnvironment(\Seerbit\Environment::LIVE);


        //SETUP CREDENTIALS
        $client->setPublicKey("SBTESTPUBK_p8GqvFSFNCBahSJinczKd9aIPoRUZfda");
        $client->setSecretKey("SBTESTSECK_kFgKytQK1KSvbR616rUMqNYOUedK3Btm5igZgxaZ");

        $uuid = bin2hex(random_bytes(6));
        $transaction_ref = strtoupper(trim($uuid));
        //Instantiate Mobile Money Service
        $service = New MobileService($client);

        //Build PayLoad
        $data =
            '{   
            "fullName":"john doe",
            "email":"johndoe@gmail.com",
            "mobileNumber":"08022343345",
            "currency": "GHS",
            "country": "GH",
            "network":"MTN",
            "amount": "10.01",
            "paymentType":"MOMO"
            }';

        //Decode to associated array
        $payload = json_decode($data, true);
        $payload['paymentReference'] = $transaction_ref;

        $result = $service->Authorize($payload);

        $this->assertArrayHasKey("httpStatus",$result->toArray());

        $this->assertEquals("200",$result->toArray()["httpStatus"]);
    }
}