<?php

namespace Seerbit\Request;


use PHPUnit\Framework\TestCase;
use Seerbit\Client;
use Seerbit\Service\Standard\StandardService;

class StandardTest extends TestCase
{

    use TestHelper;

    public function testInitialize(){

        $client = TestHelper::SeerBitServiceBearer();
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