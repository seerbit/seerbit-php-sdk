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
	    "currency":"NGN",
	    "country":"NG",
	    "amount":"100.00"
        }';

    $payload = json_decode($json, true);
    $payload['paymentReference'] = "D14FBF7C4F33";

    $transaction = $card_service->Refund($payload);

    echo($transaction->toJson());


}catch (\Exception $exception){
    echo $exception->getMessage();
}