<?php

namespace Seerbit\Request;


use PHPUnit\Framework\TestCase;
use Seerbit\Client;
use Seerbit\Service\Order\OrderService;

class OrderTest extends TestCase
{

    public function testCreateOrder(){
        $client = TestHelper::SeerBitServiceBearer();

        $uuid = bin2hex(random_bytes(6));
        $transaction_ref = strtoupper(trim($uuid));

        //Instantiate Mobile Money Service
        $service = New OrderService($client);

        //Build PayLoad
        $data = '{
        "email":"johndoe@gmail.com",
		"fullName":"John Doe",
		"orderType":"BULK_BULK",
		"callbackUrl":"https://yourdomain.com",
		"country":"NG",
		"currency":"NGN",
		"amount":"1400",
		"orders":[
			{
			"orderId":"22S789420214623",
			"currency":"NGN",
			"amount":"500.00",
			"productId":"fruits",
			"productDescription":"mango"
			},
			{
			"orderId":"1a3sa82748272556947",
			"currency":"NGN",
			"amount":"900.00",
			"productId":"fruits",
			"productDescription":"orange"
			}
		]}';

        //Decode to associated array
        $payload = json_decode($data, true);
        $payload['paymentReference'] = $transaction_ref;

        $transaction = $service->Create($payload);

        $this->assertArrayHasKey("httpStatus",$transaction->toArray());

        $this->assertEquals("200",$transaction->toArray()["httpStatus"]);
    }

}