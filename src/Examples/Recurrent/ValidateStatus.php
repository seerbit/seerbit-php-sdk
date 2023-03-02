<?php
ini_set("display_errors", 1);

use Seerbit\Client;
use Seerbit\Service\Status\TransactionStatusService;

require __DIR__ . '/../../../vendor/autoload.php';

try {
    $token = "MERCHANT_TOKEN";
    //Instantiate SeerBit Client
    $client = new Client();

    //Configure SeerBit Client
    $client->setToken($token);

    //SETUP CREDENTIALS
    $client->setPublicKey("MERCHANT_PUBLIC_KEY");

    //Instantiate Mobile Money Service
    $service = New TransactionStatusService($client);


    $transaction = $service->ValidateSubscriptionStatus("1D3478A0F6CE");

    header('Content-Type: application/json');
    echo($transaction->toJson());


} catch (\Exception $exception) {
    echo $exception->getMessage();
}