<?php

namespace Seerbit\Request;


use PHPUnit\Framework\TestCase;
use Seerbit\Client;
use Seerbit\Service\Standard\StandardService;

class StandardTest extends TestCase
{

    public function testInitialize(){
        $token = "1KWLzpZkWaoXO9AN4qweKwqLjGcQSNt8kjeVjsdTG4lPlwg6sTvpVAay2RA7hoCEzHPkIQa+MNfDepx4VBr5JMgLb5Q5anq9XoN2pXU850bumqBWFVw1T1ZW5w8N+Sq/";
        //Instantiate SeerBit Client
        $client = new Client();
        $client->setLoggerPath(dirname(__FILE__));
        $client->setToken($token);
        //Configure SeerBit Client
        $client->setEnvironment(\Seerbit\Environment::LIVE);
        $client->setAuthType(\Seerbit\AuthType::BEARER);

        //SETUP CREDENTIALS
        $client->setPublicKey("SBTESTPUBK_p8GqvFSFNCBahSJinczKd9aIPoRUZfda");
        $client->setSecretKey("SBTESTSECK_kFgKytQK1KSvbR616rUMqNYOUedK3Btm5igZgxaZ");

        //Instantiate Resource Service
        $standard_service =  New StandardService($client);
        $uuid = bin2hex(random_bytes(6));
        $transaction_ref = strtoupper(trim($uuid));

        //the order of placement is important
        $payload = [
        "amount" => "1000",
        "callbackUrl" => "http:yourwebsite.com",
        "country" => "NG",
        "currency" => "NGN",
        "email" => "customer@email.com",
        "paymentReference" => $transaction_ref,
        "productDescription" => "product_description",
        "productId" => "64310880-2708933-427"
        ];

        $transaction = $standard_service->Initialize($payload);

        $this->assertArrayHasKey("httpStatus",$transaction->toArray());

        $this->assertEquals("200",$transaction->toArray()["httpStatus"]);
    }

}