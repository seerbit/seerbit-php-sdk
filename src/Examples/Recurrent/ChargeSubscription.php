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

    //Instantiate Service
    $service = New RecurrentService($client);

    //Build PayLoad
    $data = '{ 
        "amount":"20",
        "currency":"NGN",
        "email":"johndoe@gmail.com",
        "paymentReference":"9B9132E6BBD2",
        "authorizationCode":"54570064E849"
        }';

    //Decode to associated array
    $payload = json_decode($data, true);

    $transaction = $service->ChargeSubscription($payload);

    header('Content-Type: application/json');
    echo($transaction->toJson());


} catch (\Exception $exception) {
    echo $exception->getMessage();
}