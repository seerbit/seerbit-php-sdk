<?php

namespace Seerbit\Request;


use PHPUnit\Framework\TestCase;
use Seerbit\Client;
use Seerbit\Service\Status\TransactionStatusService;

class RecurrentValidationTest extends TestCase
{

    use TestHelper;

    public function testSubscriptionValidateStatus()
    {
        $client = TestHelper::SeerBitServiceBearer();
        //Instantiate Mobile Money Service
        $service = New TransactionStatusService($client);

        $transaction = $service->ValidateSubscriptionStatus("SBT-R78694421820");
        $this->assertArrayHasKey("httpStatus",$transaction->toArray());

        $this->assertEquals("200",$transaction->toArray()["httpStatus"]);

    }

}