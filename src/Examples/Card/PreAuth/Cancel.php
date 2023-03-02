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
	    "country":"KE"
        }';

    $payload = json_decode($json, true);
    $payload['paymentReference'] = "D14FBF7C4F33";

    $transaction = $card_service->Cancel($payload);

    echo($transaction->toJson());


}catch (\Exception $exception){
    echo $exception->getMessage();
}