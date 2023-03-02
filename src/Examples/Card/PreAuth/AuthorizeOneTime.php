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
    $client->setSecretKey("MERCHANT_SECRET_KEY");

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

    echo($transaction->toJson());

}catch (\Exception $exception){
    echo $exception->getMessage();
}