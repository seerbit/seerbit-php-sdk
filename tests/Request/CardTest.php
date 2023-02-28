<?php

namespace Seerbit\Request;


use PHPUnit\Framework\TestCase;
use Seerbit\Client;
use Seerbit\Service\Card\CardService;

class CardTest extends TestCase
{

    public function testCardAuthorizeOnetime(){

        $client = TestHelper::SeerBitServiceBasic();
        //Instantiate Card Service
        $card_service =  New CardService($client);
        $uuid = bin2hex(random_bytes(6));
        $transaction_ref = strtoupper(trim($uuid));

        $json = '{
        "currency": "NGN",
	    "country": "NG",
        "cardNumber":"5123450000000008",
        "expiryMonth":"06",
        "expiryYear":"21",
        "amount":"100.00",
        "cvv":"100",
        "email":"anonshopper@gmail.com",
        "fullName":"Anonymous Shopper"
        }';

        $payload = json_decode($json, true);
        $payload['paymentReference'] = $transaction_ref;

        $transaction = $card_service->AuthorizeOneTime($payload);

        $this->assertArrayHasKey("httpStatus",$transaction->toArray());

        $this->assertEquals("201",$transaction->toArray()["httpStatus"]);
    }

    public function testCardAuthorizeWithToken(){
        $client = TestHelper::SeerBitServiceBasic();

        //Instantiate Card Service
        $card_service =  New CardService($client);
        $uuid = bin2hex(random_bytes(6));
        $transaction_ref = strtoupper(trim($uuid));

        $json = '{
        "currency": "NGN",
	    "country": "NG",
        "cardToken":"tk_1d67fb8a-ee8f-4fad-80e7-c30d2d20e7c4",
        "amount":"100.00",
        "email":"anonshopper@gmail.com",
        "fullName":"Anonymous Shopper"
        }';

        $payload = json_decode($json, true);
        $payload['paymentReference'] = $transaction_ref;

        $transaction = $card_service->AuthorizeWithToken($payload);

        $this->assertArrayHasKey("httpStatus",$transaction->toArray());

        $this->assertEquals("201",$transaction->toArray()["httpStatus"]);
    }

    public function testCardCapture(){
        //Instantiate SeerBit Client
        $client = TestHelper::SeerBitServiceBasic();

        //Instantiate Card Service
        $card_service =  New CardService($client);

        $json = '{
	    "currency":"NGN",
	    "country":"NG",
	    "amount":"100.00"
        }';

        $payload = json_decode($json, true);
        $payload['paymentReference'] = "D14FBF7C4F33";

        $transaction = $card_service->Capture($payload);

        $this->assertArrayHasKey("httpStatus",$transaction->toArray());

        $this->assertEquals("200",$transaction->toArray()["httpStatus"]);
    }

    public function testCardCancel(){
        //Instantiate SeerBit Client
        $client = TestHelper::SeerBitServiceBasic();

        //Instantiate Card Service
        $card_service =  New CardService($client);

        $json = '{
	    "country":"NG"
        }';

        $payload = json_decode($json, true);
        $payload['paymentReference'] = "D14FBF7C4F33";

        $transaction = $card_service->Cancel($payload);

        $this->assertArrayHasKey("httpStatus",$transaction->toArray());

        $this->assertEquals("200",$transaction->toArray()["httpStatus"]);
    }

    public function testCardRefund(){
        //Instantiate SeerBit Client
        $client = TestHelper::SeerBitServiceBasic();

        //Instantiate Card Service
        $card_service =  New CardService($client);

        $json = '{
	    "currency":"NGN",
	    "country":"NG",
	    "amount":"100.00"
        }';

        $payload = json_decode($json, true);
        $payload['paymentReference'] = "D14FBF7C4F33";

        $transaction = $card_service->Refund($payload);

        $this->assertArrayHasKey("httpStatus",$transaction->toArray());

        $this->assertEquals("200",$transaction->toArray()["httpStatus"]);
    }

    public function testTokenize(){
        //Instantiate SeerBit Client
        $client = TestHelper::SeerBitServiceBasic();

        $uuid = bin2hex(random_bytes(6));
        $transaction_ref = strtoupper(trim($uuid));

        //Instantiate Card Service
        $card_service =  New CardService($client);

        $json = '{
        "fullName":"Sam King",
        "currency": "NGN",
	    "country": "NG",
        "cardNumber":"5123450000000008",
        "expiryMonth":"06",
        "expiryYear":"21"
        }';

        $payload = json_decode($json, true);
        $payload['paymentReference'] = $transaction_ref;

        $transaction = $card_service->Tokenize($payload);

        $this->assertArrayHasKey("httpStatus",$transaction->toArray());

        $this->assertEquals("201",$transaction->toArray()["httpStatus"]);
    }

    public function testNon3DSOneTime(){
        //Instantiate SeerBit Client
        $client = TestHelper::SeerBitServiceBasic();

        //Instantiate Card Service
        $card_service =  New CardService($client);
        $uuid = bin2hex(random_bytes(6));
        $transaction_ref = strtoupper(trim($uuid));

        $json = '{
        "amount":"1000.00",
        "fullName":"john doe",
        "mobileNumber":"08033456599",
        "currency":"NGN",
        "country":"NG",
        "email":"johndoe@gmail.com",
        "cardNumber":"5123450000000008",
        "cvv":"100",
        "expiryMonth":"05",
        "expiryYear":"21",
        "pin":"1234"
        }';

        $payload = json_decode($json, true);
        $payload['paymentReference'] = $transaction_ref;

        $transaction = $card_service->ChargeNon3DOneTime($payload);

        $this->assertArrayHasKey("httpStatus",$transaction->toArray());

        $this->assertEquals("200",$transaction->toArray()["httpStatus"]);
    }

    public function testNon3DWithToken(){
        //Instantiate SeerBit Client
        $client = TestHelper::SeerBitServiceBasic();

        //Instantiate Card Service
        $card_service =  New CardService($client);
        $uuid = bin2hex(random_bytes(6));
        $transaction_ref = strtoupper(trim($uuid));

        $json = '{
        "amount":"1000.00",
        "fullName":"john doe",
        "currency":"NGN",
        "country":"NG",
        "email":"johndoe@gmail.com",
	    "cardToken":"tk_e4cae021-e2ce-4b59-9b1e-3f859cefd800"
        }';

        $payload = json_decode($json, true);
        $payload['paymentReference'] = $transaction_ref;

        $transaction = $card_service->ChargeNon3DSWithToken($payload);

        $this->assertArrayHasKey("httpStatus",$transaction->toArray());

        $this->assertEquals("201",$transaction->toArray()["httpStatus"]);
    }
}