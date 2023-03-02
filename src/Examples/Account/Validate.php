<?php
ini_set("display_errors", 1);

use Seerbit\Client;
use Seerbit\SeerbitException;
use Seerbit\Service\Account\AccountService;
require __DIR__ . '/../../../vendor/autoload.php';

try{
    $token = "MERCHANT_TOKEN";
    //Instantiate SeerBit Client
    $client = new Client();

    //Configure SeerBit Client
    $client->setToken($token);

    //SETUP CREDENTIALS
    $client->setPublicKey("MERCHANT_PUBLIC_KEY");

    $card_service =  New AccountService($client);

    $json = '{
        "linkingReference":"F121934771596484765108",
        "otp":"00234242"
        }';

    $payload = json_decode($json, true);
    $transaction = $card_service->Validate($payload);

    header('Content-Type: application/json');
    echo($transaction->toJson());

}catch (SeerbitException $exception){
    echo $exception->getMessage();
}