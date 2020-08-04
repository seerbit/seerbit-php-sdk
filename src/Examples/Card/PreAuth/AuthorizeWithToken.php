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
        "cardToken":"tk_1d67fb8a-ee8f-4fad-80e7-c30d2d20e7c4",
        "amount":"100.00",
        "email":"anonshopper@gmail.com",
        "fullName":"Anonymous Shopper"
        }';

    $payload = json_decode($json, true);
    $payload['paymentReference'] = $transaction_ref;

    $transaction = $card_service->AuthorizeWithToken($payload);


    echo($transaction->toJson());

}catch (\Exception $exception){
    echo $exception->getMessage();
}