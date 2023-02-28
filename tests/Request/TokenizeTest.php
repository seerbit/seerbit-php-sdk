<?php


namespace Seerbit\Request;


use PHPUnit\Framework\TestCase;
use Seerbit\Client;
use Seerbit\Service\Card\TokenizeService;

class TokenizeTest extends TestCase
{

    public function testTokenize(){
        $client = TestHelper::SeerBitServiceBearer();
        //Instantiate Card Service
        $service =  New TokenizeService($client);
        $uuid = bin2hex(random_bytes(6));
        $transaction_ref = strtoupper(trim($uuid));
        
        $json = '{
        "amount": "100.00",
        "fullName": "Anonymous Shopper",
        "mobileNumber": "03447522256",
        "currency": "NGN",
        "country": "NG",
        "email": "anonshopper@gmail.com",
        "paymentType": "CARD",
        "cardNumber": "6280511000000095",
        "expiryMonth": "12",
        "expiryYear": "26",
        "cvv": "123",
        "pin": "1234"
        }';

        $payload = json_decode($json, true);
        $payload['paymentReference'] = $transaction_ref;
        $payload['tokenize'] = true;

        $transaction = $service->CreateToken($payload);
  
        $this->assertEquals("200",$transaction->toArray()["httpStatus"]);
        $this->assertArrayHasKey("httpStatus",$transaction->toArray());
        $this->assertArrayHasKey("data",$transaction->toArray());
        $this->assertEquals("S20",$transaction->toArray()["data"]['code']);


        //VALIDATE OTP
        $validate_payload = [
            'linkingreference' => $transaction->toArray()['data']['payments']['linkingReference'], 
            'otp' => '123456'
        ];
        $validateOtp = $service->ValidateOtp($validate_payload);
        $this->assertEquals("200",$validateOtp->toArray()["httpStatus"]);
        $this->assertEquals("00",$validateOtp->toArray()["data"]['code']);

        //GET TOKEN
        $getToken = $service->GetToken($transaction_ref);
        $this->assertEquals("200",$getToken->toArray()["httpStatus"]);
        $this->assertEquals("00",$getToken->toArray()["data"]['code']);
        $this->assertArrayHasKey("authorizationCode",$getToken->toArray()["data"]["payments"]);


        //CHARGE TOKEN
        $uuid = bin2hex(random_bytes(6));
        $transaction_ref = strtoupper(trim($uuid));
        $charge_token_payload = [
            'paymentReference' => $transaction_ref, 
            "authorizationCode" => $getToken->toArray()["data"]["payments"]["authorizationCode"], 
            "amount" => "100.00"
        ];
        $chargeToken = $service->ChargeToken($charge_token_payload);
        $this->assertEquals("200",$chargeToken->toArray()["httpStatus"]);
        $this->assertEquals("00",$chargeToken->toArray()["data"]['code']);

        

        //CHARGE TOKEN BULK
        // $uuid = bin2hex(random_bytes(6));
        // $transaction_ref = strtoupper(trim($uuid));
        // $payload = [
        //     (object)[
        //     'authorizationCode' => $getToken->toArray()["data"]["payments"]["authorizationCode"],
        //     'paymentReference' => $transaction_ref,
        //     'amount' => '100.00',
        //     'publicKey' => 'SBTESTPUBK_4v0JR58modUFJjF1Es206pveBQjOLxe2'
        //     ]
        // ];
        // $chargeTokenBulk = $service->ChargeTokenBULK($payload);
        // $this->assertEquals("200",$chargeTokenBulk->toArray()["httpStatus"]);
        // $this->assertEquals("00",$chargeTokenBulk->toArray()["data"]['code']);

    }

}