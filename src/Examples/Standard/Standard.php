<?php
ini_set("display_errors", 1);

use Seerbit\Client;
use Seerbit\Service\Standard\StandardService;
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
    $standard_service =  New StandardService($client);

    $uuid = bin2hex(random_bytes(6));
    $transaction_ref = strtoupper(trim($uuid));

    //the order of placement is important
    $payload = [
        "amount" => "1000",
        "callbackUrl" => "http:yourwebsite.com",
        "country" => "NG",
        "currency" => "NGN",
        "email" => "customer@email.com",
        "paymentReference" => $transaction_ref,
        "productDescription" => "product_description",
        "productId" => "64310880-2708933-427",
        "tokenize" => true, //optional
    ];

    $transaction = $standard_service->Initialize($payload);

    echo($transaction->toJson());

}catch (\Exception $exception){
    echo $exception->getMessage();
}