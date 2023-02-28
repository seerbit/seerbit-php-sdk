<?php

namespace Seerbit\Request;


use PHPUnit\Framework\TestCase;
use Seerbit\Client;
use Seerbit\Service\Mobile\MobileService;

class MomoTest extends TestCase
{

    public function testMomoNetworks(){
        $client = TestHelper::SeerBitServiceBearer();


        //Instantiate Mobile Money Service
        $service = New MobileService($client);

        $result = $service->Networks();

        $this->assertArrayHasKey("httpStatus",$result->toArray());

        $this->assertEquals("200",$result->toArray()["httpStatus"]);
    }

    public function testMomoAuthorize(){
        $client = TestHelper::SeerBitServiceBearer();

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