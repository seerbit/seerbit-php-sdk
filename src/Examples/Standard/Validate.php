<?php
ini_set("display_errors", 1);

use Seerbit\Client;
use Seerbit\Service\Status\TransactionStatusService;

require __DIR__ . '/../../../vendor/autoload.php';

try{
    $token = "MERCHANT_TOKEN";
    //Instantiate SeerBit Client
    $client = new Client();

    //Configure SeerBit Client
    $client->setToken($token);

    //SETUP CREDENTIALS
    $client->setPublicKey("MERCHANT_PUBLIC_KEY");

    //Instantiate Mobile Money Service
    $service = New TransactionStatusService($client);

    $transaction = $service->ValidateTransactionStatus("TRANSACTION_REFERENCE");

    echo($transaction->toJson());

}catch (\Exception $exception){
    echo $exception->getMessage();
}