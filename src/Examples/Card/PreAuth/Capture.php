<?php
ini_set("display_errors", 1);

use Seerbit\Client;
use Seerbit\Service\Card\CardService;

require __DIR__ . '/../../../../vendor/autoload.php';

try {
    //Instantiate SeerBit Client
    $client = new Client();

    //Configure SeerBit Client
    $client->setEnvironment(\Seerbit\Environment::LIVE);
    $client->setAuthType(\Seerbit\AuthType::BASIC);
    $client->setPublicKey("SBTESTPUBK_E9CFg6iZ2uSFr8YK7C2KTontiysQRnMm");
    $client->setSecretKey("SBTESTSECK_V1ahfeTQAsyi3OaJXbMmrKNB8KTW5dyCRdUnILnw");

    //Instantiate Card Service
    $card_service =  New CardService($client);

    $json = '{
	    "currency":"KES",
	    "country":"KE",
	    "amount":"100.00"
        }';

    $payload = json_decode($json, true);
    $payload['paymentReference'] = "D14FBF7C4F33";

    $transaction = $card_service->Capture($payload);

    echo($transaction->toJson());


} catch (\Exception $exception) {
    echo $exception->getMessage();
}