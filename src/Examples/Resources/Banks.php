<?php
ini_set("display_errors", 1);

use Seerbit\Client;
use Seerbit\Service\Resource\ResourceService;

require __DIR__ . '/../../../vendor/autoload.php';

try{
    $token = "MERCHANT_TOKEN";
    //Instantiate SeerBit Client
    $client = new Client();

    //Configure SeerBit Client
    $client->setToken($token);

    //SETUP CREDENTIALS
    $client->setPublicKey("MERCHANT_PUBLIC_KEY");
    $client->setSecretKey("MERCHANT_SECRET_KEY");

    //Instantiate Resource Service
    $card_service =  New ResourceService($client);

    $transaction = $card_service->GetBankList();

    header('Content-Type: application/json');
    echo($transaction->toJson());

}catch (\Exception $exception){
    echo $exception->getMessage();
}