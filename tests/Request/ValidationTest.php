<?php

namespace Seerbit\Request;


use PHPUnit\Framework\TestCase;
use Seerbit\Client;
use Seerbit\Service\Status\TransactionStatusService;

class ValidationTest extends TestCase
{

    use TestHelper;

    public function testTransactionValidateStatus()
    {

        $client = TestHelper::SeerBitServiceBearer();
        //Instantiate Mobile Money Service
        $service = New TransactionStatusService($client);

        $transaction = $service->ValidateTransactionStatus("E5F0D63203B2");
        $this->assertArrayHasKey("httpStatus",$transaction->toArray());

        $this->assertEquals("200",$transaction->toArray()["httpStatus"]);

    }

    public function testSubscriptionValidateStatus()
    {
        $client = TestHelper::SeerBitServiceBearer();
        //Instantiate Mobile Money Service
        $service = New TransactionStatusService($client);

        $transaction = $service->ValidateSubscriptionStatus("1D3478A0F6CE");
        $this->assertArrayHasKey("httpStatus",$transaction->toArray());

        $this->assertEquals("200",$transaction->toArray()["httpStatus"]);

    }

}