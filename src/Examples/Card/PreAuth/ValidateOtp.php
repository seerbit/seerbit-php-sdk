<?php
ini_set("display_errors", 1);

use Seerbit\Client;
use Seerbit\Service\Card\CardService;

require __DIR__ . '/../../../vendor/autoload.php';

try {
    $token = "MERCHANT_TOKEN";
    //Instantiate SeerBit Client
    $client = new Client();

    //Configure SeerBit Client
    $client->setToken($token);

    //SETUP CREDENTIALS
    $client->setPublicKey("MERCHANT_PUBLIC_KEY");
    $client->setSecretKey("MERCHANT_SECRET_KEY");


    //Instantiate Card Service
    $card_service =  New CardService($client);

    //Build OTP PayLoad
     $json = '{
     "linkingReference":"F123500031595153273381",
        "otp":"00234242"
     }';

     //Decode to associated array
     $payload = json_decode($json, true);

    //Validate OTP
    $transaction = $card_service->ValidateOtp($payload);
    header('Content-Type: application/json');
    echo($transaction->toJson());

}catch (\Exception $exception){
    echo $exception->getMessage();
}