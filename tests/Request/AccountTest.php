<?php


namespace Seerbit\Request;


use PHPUnit\Framework\TestCase;
use Seerbit\Client;
use Seerbit\Service\Authenticate;
use Seerbit\Service\Card\CardService;

class AccountTest extends TestCase
{

    public function testAccountTransaction(){
        $client = new Client();
        $client->setPublicKey("SBTESTPUBK_PjQ5dFOi522L383MlsQYUMAe6cZYviTF");
        $client->setPrivateKey("SBTESTSECK_9CDyHxbubCHnqJba5iiIytD5TLyySiHNvBY1UhPX");

        $client->setEnvironment(\Seerbit\Environment::LIVE);

        //Instantiate Authentication Service
        $authService = new Authenticate($client);

        //Get Auth
        $auth = $authService->Auth();

        //Get Auth Token
        $auth_token= $auth->getToken();

        $card_service =  New CardService($client, $auth_token);
        $uuid = bin2hex(random_bytes(6));
        $transaction_ref = strtoupper(trim($uuid));

        $json = '{
          "fullname":"Aminu Grod",
          "email":"kolawolesam@gmail.com",
          "mobile":"03200000",
          "channelType":"mastercard",
          "type":"3DSECURE",
          "deviceType":"samsung s3",
          "sourceIP":"1.0.0.1",
          "currency": "NGN",
          "description": "Integration Transaction",
          "country": "NG",
          "fee": "1.00",
          "amount": "250.00",
          "tranref":"",
          "clientappcode":"app1",
          "callbackurl":"http://testing-test.surge.sh",
          "redirecturl":"http://bc-design.surge.sh",
          "card":{
          "number":"5061040201593455366",
            "cvv":"100",
            "expirymonth":"05",
            "expiryyear":"21",
            "pin": "8319"
            }
        }';

        $payload = json_decode($json, true);
        $payload['tranref'] = $transaction_ref;
        $transaction = $card_service->Authorize($payload);

        $this->assertArrayHasKey("code",$transaction->toArray());

        $this->assertEquals("S20",$transaction->toArray()['code']);
    }
}