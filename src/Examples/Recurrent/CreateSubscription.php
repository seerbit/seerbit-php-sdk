<?php
ini_set("display_errors", 1);

use Seerbit\Client;
use Seerbit\Service\Recurrent\RecurrentService;

require __DIR__ . '/../../../vendor/autoload.php';

try {
    $token = "pCEdKBei+5OLwaCamMlyct9dtHGFUyT35MVQZ5rYaQ5e6Eoj1amt/25WK8ZCWqN4ZPQlgar953PgHorH1RUoAJB6ZK5k5d+yAjmN0EcYpDSDQeEMMZuvUHZVXcXHwRyW";
    //Instantiate SeerBit Client
    $client = new Client();
    $client->setToken($token);
    //Configure SeerBit Client
    $client->setEnvironment(\Seerbit\Environment::LIVE);

    //SETUP CREDENTIALS
    $client->setPublicKey("SBTESTPUBK_PjQ5dFOi522L383MlsQYUMAe6cZYviTF");
    $uuid = bin2hex(random_bytes(6));
    $transaction_ref = strtoupper(trim($uuid));
    //Instantiate Mobile Money Service
    $service = New RecurrentService($client);

    //Build PayLoad
    $data = '{ 
    "planId":"",
    "cardNumber":"2223000000000007",
    "expiryMonth":"05",
    "callbackUrl":"https://callback.url.com",
    "expiryYear":"21",
    "cvv":"100",
    "amount":"20",
    "currency":"NGN",
    "productDescription":"Test Token",
    "productId":"Terrain",
    "country":"NG",
    "startDate":"2019-01-11",
    "cardName":"Bola Olat",
    "billingCycle":"DAILY",
    "email":"johndoe@gmail.com",
    "mobileNumber":"09022323537", 
    "customerId":"199721652416534",
    "billingPeriod":"4"
    }';

    //Decode to associated array
    $payload = json_decode($data, true);
    $payload['paymentReference'] = $transaction_ref;

    $transaction = $service->CreateSubscription($payload);
    echo($transaction->toJson());


} catch (\Exception $exception) {
    echo $exception->getMessage();
}