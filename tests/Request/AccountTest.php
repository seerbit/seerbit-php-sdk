<?php


namespace Seerbit\Request;


use PHPUnit\Framework\TestCase;
use Seerbit\Client;
use Seerbit\Service\Account\AccountService;

class AccountTest extends TestCase
{

    public function testAccountAuthentication(){
        $token = "1KWLzpZkWaoXO9AN4qweKwqLjGcQSNt8kjeVjsdTG4lPlwg6sTvpVAay2RA7hoCEzHPkIQa+MNfDepx4VBr5JMgLb5Q5anq9XoN2pXU850bumqBWFVw1T1ZW5w8N+Sq/";
        //Instantiate SeerBit Client
        $client = new Client();
        $client->setToken($token);

        $client->setEnvironment(\Seerbit\Environment::LIVE);
        $client->setAuthType(\Seerbit\AuthType::BEARER);

        //SETUP CREDENTIALS
        $client->setPublicKey("SBTESTPUBK_p8GqvFSFNCBahSJinczKd9aIPoRUZfda");
        $client->setSecretKey("SBTESTSECK_kFgKytQK1KSvbR616rUMqNYOUedK3Btm5igZgxaZ");


        $card_service =  New AccountService($client);
        $uuid = bin2hex(random_bytes(6));
        $transaction_ref = strtoupper(trim($uuid));

        $json = '{
        "amount":"1000.00",
        "accountName":"Customer Bank Account Name",
        "accountNumber":"1234567890",
        "bankCode":"033",
        "currency":"NGN",
        "country":"NG",
        "email":"customer@email.com"
        }';

        $payload = json_decode($json, true);
        $payload['paymentReference'] = $transaction_ref;
        $transaction = $card_service->Authorize($payload);

        $this->assertArrayHasKey("httpStatus",$transaction->toArray());

        $this->assertEquals("S20",$transaction->toArray()["data"]['code']);
    }

    public function testAccountOtpValidation(){
        $token = "1KWLzpZkWaoXO9AN4qweKwqLjGcQSNt8kjeVjsdTG4lPlwg6sTvpVAay2RA7hoCEzHPkIQa+MNfDepx4VBr5JMgLb5Q5anq9XoN2pXU850bumqBWFVw1T1ZW5w8N+Sq/";
        //Instantiate SeerBit Client
        $client = new Client();
        $client->setToken($token);
        $client->setEnvironment(\Seerbit\Environment::LIVE);
        $client->setAuthType(\Seerbit\AuthType::BEARER);


        //SETUP CREDENTIALS
        $client->setPublicKey("SBTESTPUBK_p8GqvFSFNCBahSJinczKd9aIPoRUZfda");
        $client->setSecretKey("SBTESTSECK_kFgKytQK1KSvbR616rUMqNYOUedK3Btm5igZgxaZ");

        $card_service =  New AccountService($client);

        $json = '{
        "linkingReference":"F121934771596484765108",
        "otp":"00234242"
        }';

        $payload = json_decode($json, true);
        $transaction = $card_service->Validate($payload);

        $this->assertArrayHasKey("httpStatus",$transaction->toArray());

    }
}