<?php

namespace Seerbit\Request;


use PHPUnit\Framework\TestCase;
use Seerbit\Client;
use Seerbit\Service\Status\TransactionStatusService;

class ValidationTest extends TestCase
{

    public function testTransactionValidateStatus()
    {
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

        //Instantiate Mobile Money Service
        $service = New TransactionStatusService($client);

        $transaction = $service->ValidateTransactionStatus("E5F0D63203B2");
        $this->assertArrayHasKey("httpStatus",$transaction->toArray());

        $this->assertEquals("200",$transaction->toArray()["httpStatus"]);

    }

    public function testSubscriptionValidateStatus()
    {
        $token = "pCEdKBei+5OLwaCamMlyct9dtHGFUyT35MVQZ5rYaQ5e6Eoj1amt/25WK8ZCWqN4ZPQlgar953PgHorH1RUoAJB6ZK5k5d+yAjmN0EcYpDSDQeEMMZuvUHZVXcXHwRyW";
        //Instantiate SeerBit Client
        $client = new Client();

        //Configure SeerBit Client
        $client->setToken($token);
        $client->setEnvironment(\Seerbit\Environment::LIVE);
        $client->setAuthType(\Seerbit\AuthType::BEARER);
        //SETUP CREDENTIALS

        $client->setPublicKey("SBTESTPUBK_9e6b6DNiSP2gxOKXfyXhijzEMRHphtOd");
        $client->setSecretKey("SBTESTSECK_ZfqoNFaGmQRxaPOn2VSfkWfBTj7u0fUjgkStmYFC");

        //Instantiate Mobile Money Service
        $service = New TransactionStatusService($client);


        $transaction = $service->ValidateSubscriptionStatus("1D3478A0F6CE");
        $this->assertArrayHasKey("httpStatus",$transaction->toArray());

        $this->assertEquals("200",$transaction->toArray()["httpStatus"]);

    }

}