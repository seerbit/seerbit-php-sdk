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
        "amount":"1000.00",
        "fullName":"john doe",
        "currency":"NGN",
        "country":"NG",
        "email":"johndoe@gmail.com",
	    "cardToken":"tk_e4cae021-e2ce-4b59-9b1e-3f859cefd800"
        }';

    $payload = json_decode($json, true);
    $payload['paymentReference'] = $transaction_ref;

    $transaction = $card_service->ChargeNon3DSWithToken($payload);

    echo($transaction->toJson());



}catch (\Exception $exception){
    echo $exception->getMessage();
}