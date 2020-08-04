<?php
ini_set("display_errors", 1);

use Seerbit\Client;
use Seerbit\Service\Card\CardService;
require __DIR__ . '/../../../../vendor/autoload.php';

try{
    //Instantiate SeerBit Client
    $client = new Client();
    //Configure SeerBit Client
    $client->setEnvironment(\Seerbit\Environment::LIVE);
    $client->setAuthType(\Seerbit\AuthType::BASIC);

    $client->setPublicKey("SBTESTPUBK_E9CFg6iZ2uSFr8YK7C2KTontiysQRnMm");
    $client->setSecretKey("SBTESTSECK_V1ahfeTQAsyi3OaJXbMmrKNB8KTW5dyCRdUnILnw");

    //Instantiate Card Service
    $card_service =  New CardService($client);
    $uuid = bin2hex(random_bytes(6));
    $transaction_ref = strtoupper(trim($uuid));

    $json = '{
        "currency": "KES",
	    "country": "KE",
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

        echo($transaction->toJson());

}catch (\Exception $exception){
    echo $exception->getMessage();
}