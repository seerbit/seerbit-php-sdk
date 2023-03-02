<?php
ini_set("display_errors", 1);

use Seerbit\Client;
use Seerbit\Service\Recurrent\RecurrentService;

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

    $uuid = bin2hex(random_bytes(6));
    $transaction_ref = strtoupper(trim($uuid));

    //Instantiate Service
    $service = New RecurrentService($client);

    //Build PayLoad
    $data = '{ 
        "cardNumber":"2223000000000007",
        "expiryMonth":"05",
        "callbackUrl":"https://callback.url.com",
        "expiryYear":"21",
        "cvv":"100",
        "amount":"20",
        "currency":"NGN",
        "productDescription":"Medium HM",
        "productId":"mhmo",
        "country":"NG",
        "startDate":"2019-01-11",
        "cardName":"Bola Olat",
        "billingCycle":"DAILY",
        "email":"johndoe@gmail.com",
        "customerId":"199721652416534",
        "billingPeriod":"4"
        }';

    //Decode to associated array
    $payload = json_decode($data, true);
    $payload['paymentReference'] = $transaction_ref;

    $transaction = $service->CreateSubscription($payload);

    header('Content-Type: application/json');
    echo($transaction->toJson());


} catch (\Exception $exception) {
    echo $exception->getMessage();
}