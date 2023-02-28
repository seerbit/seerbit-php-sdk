<?php

namespace Seerbit\Request;


use PHPUnit\Framework\TestCase;
use Seerbit\Client;
use Seerbit\Service\Resource\ResourceService;

class ResourcesTest extends TestCase
{

    public function testBanksList(){
        $client = TestHelper::SeerBitServiceBearer();

        //Instantiate Resource Service
        $card_service =  New ResourceService($client);

        $transaction = $card_service->GetBankList();

        $this->assertArrayHasKey("httpStatus",$transaction->toArray());

        $this->assertEquals("201",$transaction->toArray()["httpStatus"]);
    }

}