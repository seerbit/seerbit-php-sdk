<?php

namespace Seerbit\Request;


use PHPUnit\Framework\TestCase;
use Seerbit\Client;
use Seerbit\Service\Recurrent\RecurrentService;

class RecurrentTest extends TestCase
{

    public function testCreate(){
        $token = "1KWLzpZkWaoXO9AN4qweKwqLjGcQSNt8kjeVjsdTG4lPlwg6sTvpVAay2RA7hoCEzHPkIQa+MNfDepx4VBr5JMgLb5Q5anq9XoN2pXU850bumqBWFVw1T1ZW5w8N+Sq/";
        //Instantiate SeerBit Client
        $client = new Client();

        //Configure SeerBit Client
        $client->setToken($token);
        $client->setEnvironment(\Seerbit\Environment::LIVE);
        $client->setAuthType(\Seerbit\AuthType::BEARER);

        //SETUP CREDENTIALS
        $client->setPublicKey("SBTESTPUBK_p8GqvFSFNCBahSJinczKd9aIPoRUZfda");
        $client->setSecretKey("SBTESTSECK_kFgKytQK1KSvbR616rUMqNYOUedK3Btm5igZgxaZ");

        $uuid = bin2hex(random_bytes(6));
        $transaction_ref = strtoupper(trim($uuid));

        //Instantiate Service
        $service = New RecurrentService($client);

        //Build PayLoad
        $data = '{ 
        "cardNumber":"2223000000000007",
        "expiryMonth":"05",
        "callbackUrl":"https://callback.url.com",
        "expiryYear":"21",
        "cvv":"100",
        "amount":"20",
        "currency":"NGN",
        "productDescription":"Medium HM",
        "productId":"mhmo",
        "country":"NG",
        "startDate":"2019-01-11",
        "cardName":"Bola Olat",
        "billingCycle":"DAILY",
        "email":"johndoe@gmail.com",
        "customerId":"199721652416534",
        "billingPeriod":"4"
        }';

        //Decode to associated array
        $payload = json_decode($data, true);
        $payload['paymentReference'] = $transaction_ref;

        $transaction = $service->CreateSubscription($payload);
        $this->assertArrayHasKey("httpStatus",$transaction->toArray());

        $this->assertEquals("200",$transaction->toArray()["httpStatus"]);
    }

    public function testCharge(){
        $token = "1KWLzpZkWaoXO9AN4qweKwqLjGcQSNt8kjeVjsdTG4lPlwg6sTvpVAay2RA7hoCEzHPkIQa+MNfDepx4VBr5JMgLb5Q5anq9XoN2pXU850bumqBWFVw1T1ZW5w8N+Sq/";
        //Instantiate SeerBit Client
        $client = new Client();

        //Configure SeerBit Client
        $client->setToken($token);
        $client->setEnvironment(\Seerbit\Environment::LIVE);
        $client->setAuthType(\Seerbit\AuthType::BEARER);

        //SETUP CREDENTIALS
        $client->setPublicKey("SBTESTPUBK_p8GqvFSFNCBahSJinczKd9aIPoRUZfda");
        $client->setSecretKey("SBTESTSECK_kFgKytQK1KSvbR616rUMqNYOUedK3Btm5igZgxaZ");

        //Instantiate Service
        $service = New RecurrentService($client);

        //Build PayLoad
        $data = '{ 
        "amount":"20",
        "currency":"NGN",
        "email":"johndoe@gmail.com",
        "paymentReference":"9B9132E6BBD2",
        "authorizationCode":"54570064E849"
        }';

        //Decode to associated array
        $payload = json_decode($data, true);

        $transaction = $service->ChargeSubscription($payload);
        $this->assertArrayHasKey("httpStatus",$transaction->toArray());

        $this->assertEquals("200",$transaction->toArray()["httpStatus"]);
    }

    public function testCustomerSubscription(){
        $token = "1KWLzpZkWaoXO9AN4qweKwqLjGcQSNt8kjeVjsdTG4lPlwg6sTvpVAay2RA7hoCEzHPkIQa+MNfDepx4VBr5JMgLb5Q5anq9XoN2pXU850bumqBWFVw1T1ZW5w8N+Sq/";
        //Instantiate SeerBit Client
        $client = new Client();

        //Configure SeerBit Client
        $client->setToken($token);
        $client->setEnvironment(\Seerbit\Environment::LIVE);
        $client->setAuthType(\Seerbit\AuthType::BEARER);

        //SETUP CREDENTIALS
        $client->setPublicKey("SBTESTPUBK_p8GqvFSFNCBahSJinczKd9aIPoRUZfda");
        $client->setSecretKey("SBTESTSECK_kFgKytQK1KSvbR616rUMqNYOUedK3Btm5igZgxaZ");

        //Instantiate Service
        $service = New RecurrentService($client);

        $customerId = "55T442W";

        $transaction = $service->GetCustomerSubscription($customerId);

        $this->assertArrayHasKey("httpStatus",$transaction->toArray());

        $this->assertEquals("200",$transaction->toArray()["httpStatus"]);
    }

    public function testMerchantSubscription(){
        $token = "1KWLzpZkWaoXO9AN4qweKwqLjGcQSNt8kjeVjsdTG4lPlwg6sTvpVAay2RA7hoCEzHPkIQa+MNfDepx4VBr5JMgLb5Q5anq9XoN2pXU850bumqBWFVw1T1ZW5w8N+Sq/";
        //Instantiate SeerBit Client
        $client = new Client();

        //Configure SeerBit Client
        $client->setToken($token);
        $client->setEnvironment(\Seerbit\Environment::LIVE);
        $client->setAuthType(\Seerbit\AuthType::BEARER);

        //SETUP CREDENTIALS
        $client->setPublicKey("SBTESTPUBK_p8GqvFSFNCBahSJinczKd9aIPoRUZfda");
        $client->setSecretKey("SBTESTSECK_kFgKytQK1KSvbR616rUMqNYOUedK3Btm5igZgxaZ");

        //Instantiate Mobile Money Service
        $service = New RecurrentService($client);

        $transaction = $service->GetMerchantSubscription();

        $this->assertArrayHasKey("httpStatus",$transaction->toArray());

        $this->assertEquals("200",$transaction->toArray()["httpStatus"]);
    }

    public function testUpdateSubscription(){
        $token = "1KWLzpZkWaoXO9AN4qweKwqLjGcQSNt8kjeVjsdTG4lPlwg6sTvpVAay2RA7hoCEzHPkIQa+MNfDepx4VBr5JMgLb5Q5anq9XoN2pXU850bumqBWFVw1T1ZW5w8N+Sq/";
        //Instantiate SeerBit Client
        $client = new Client();

        //Configure SeerBit Client
        $client->setToken($token);
        $client->setEnvironment(\Seerbit\Environment::LIVE);
        $client->setAuthType(\Seerbit\AuthType::BEARER);

        //SETUP CREDENTIALS
        $client->setPublicKey("SBTESTPUBK_p8GqvFSFNCBahSJinczKd9aIPoRUZfda");
        $client->setSecretKey("SBTESTSECK_kFgKytQK1KSvbR616rUMqNYOUedK3Btm5igZgxaZ");

        //Instantiate Mobile Money Service
        $service = New RecurrentService($client);

        //Build PayLoad
        $data = '{ 
        "amount":"20",
        "currency":"NGN",
        "country":"NG",
        "status":"INACTIVE",
        "email":"johndoe@gmail.com",
        "billingId":"199721652416534",
        "mobileNumber":"09339993322"
        }';

        //Decode to associated array
        $payload = json_decode($data, true);

        $transaction = $service->UpdateSubscription($payload);

        $this->assertArrayHasKey("httpStatus",$transaction->toArray());

        $this->assertEquals("200",$transaction->toArray()["httpStatus"]);
    }


}