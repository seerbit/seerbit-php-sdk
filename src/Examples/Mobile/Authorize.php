<?php
ini_set("display_errors", 1);

use Seerbit\Client;
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

    $uuid = bin2hex(random_bytes(6));
    $transaction_ref = strtoupper(trim($uuid));
    //Instantiate Mobile Money Service
    $service = New MobileService($client);

    //Build PayLoad
    $data =
    '{   
    "fullName":"john doe",
    "email":"johndoe@gmail.com",
    "mobileNumber":"08022343345",
    "currency": "GHS",
    "country": "GH",
    "network":"MTN",
    "amount": "10.01",
    "paymentType":"MOMO"
    }';

    //Decode to associated array
    $payload = json_decode($data, true);
    $payload['paymentReference'] = $transaction_ref;

    $result = $service->Authorize($payload);

    header('Content-Type: application/json');
    echo($result->toJson());

} catch (\Exception $exception) {
    echo $exception->getMessage();
}