<?php
ini_set("display_errors", 1);

use Seerbit\Client;
use Seerbit\Service\Card\CardService;
require __DIR__ . '/../../../../vendor/autoload.php';

try{
    //Instantiate SeerBit Client
    $client = new Client();

    //SETUP CREDENTIALS
    $client->setPublicKey("MERCHANT_PUBLIC_KEY");

    //Instantiate Card Service
    $card_service =  New CardService($client);

    $json = '{
        "fullName":"Victor Ighalo",
        "currency": "KES",
	    "country": "KE",
        "cardNumber":"5123450000000008",
        "expiryMonth":"06",
        "expiryYear":"21"
        }';

    $payload = json_decode($json, true);
    $payload['paymentReference'] = "3423232B232323";

    $transaction = $card_service->Tokenize($payload);

    echo($transaction->toJson());



}catch (\Exception $exception){
    echo $exception->getMessage();
}