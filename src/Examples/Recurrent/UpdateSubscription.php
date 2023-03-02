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
    //Instantiate Mobile Money Service
    $service = New RecurrentService($client);

    //Build PayLoad
    $data = '{ 
        "amount":"20",
        "currency":"NGN",
        "country":"NG",
        "status":"INACTIVE",
        "email":"johndoe@gmail.com",
        "billingId":"199721652416534",
        "mobileNumber":"09339993322"
        }';

    //Decode to associated array
    $payload = json_decode($data, true);

    $transaction = $service->UpdateSubscription($payload);

    header('Content-Type: application/json');
    echo($transaction->toJson());


} catch (\Exception $exception) {
    echo $exception->getMessage();
}