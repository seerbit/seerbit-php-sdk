<?php

namespace Seerbit\Request;


use PHPUnit\Framework\TestCase;
use Seerbit\Client;
use Seerbit\Service\Status\TransactionStatusService;

class ValidationTest extends TestCase
{

    public function testTransactionValidateStatus()
    {
        $token = "pCEdKBei+5OLwaCamMlyct9dtHGFUyT35MVQZ5rYaQ5e6Eoj1amt/25WK8ZCWqN4ZPQlgar953PgHorH1RUoAJB6ZK5k5d+yAjmN0EcYpDSDQeEMMZuvUHZVXcXHwRyW";
        //Instantiate SeerBit Client
        $client = new Client();
        $client->setToken($token);

        //Configure SeerBit Client
        $client->setToken($token);
        $client->setEnvironment(\Seerbit\Environment::LIVE);
        $client->setAuthType(\Seerbit\AuthType::BEARER);

        //SETUP CREDENTIALS
        $client->setPublicKey("SBTESTPUBK_9e6b6DNiSP2gxOKXfyXhijzEMRHphtOd");
        $client->setSecretKey("SBTESTSECK_ZfqoNFaGmQRxaPOn2VSfkWfBTj7u0fUjgkStmYFC");

        //Instantiate Mobile Money Service
        $service = New TransactionStatusService($client);

        $transaction = $service->ValidateTransactionStatus("BDC3307BB821");
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