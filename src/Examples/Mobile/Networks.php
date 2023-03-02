<?php
ini_set("display_errors", 1);

use Seerbit\Client;
use Seerbit\SeerbitException;
use Seerbit\Service\Mobile\MobileService;

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

    //Instantiate Mobile Money Service
    $service = New MobileService($client);

    $result = $service->Networks();


    header('Content-Type: application/json');
    echo($result->toJson());

} catch (SeerbitException $exception) {
    echo $exception->getMessage();
}