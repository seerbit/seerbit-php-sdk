<?php
ini_set("display_errors", 1);

use Seerbit\Client;
use Seerbit\Service\Status\TransactionStatusService;

require __DIR__ . '/../../../vendor/autoload.php';

try{
    $token = "pCEdKBei+5OLwaCamMlyct9dtHGFUyT35MVQZ5rYaQ5e6Eoj1amt/25WK8ZCWqN4ZPQlgar953PgHorH1RUoAJB6ZK5k5d+yAjmN0EcYpDSDQeEMMZuvUHZVXcXHwRyW";
    //Instantiate SeerBit Client
    $client = new Client();
    $client->setToken($token);

    //Configure SeerBit Client
    $client->setToken($token);
    $client->setEnvironment(\Seerbit\Environment::LIVE);
    $client->setAuthType(\Seerbit\AuthType::BEARER);

    //SETUP CREDENTIALS
    $client->setPublicKey("SBTESTPUBK_9e6b6DNiSP2gxOKXfyXhijzEMRHphtOd");
    $client->setSecretKey("SBTESTSECK_ZfqoNFaGmQRxaPOn2VSfkWfBTj7u0fUjgkStmYFC");

    //Instantiate Mobile Money Service
    $service = New TransactionStatusService($client);

    $transaction = $service->ValidateTransactionStatus("BDC3307BB821");

    echo($transaction->toJson());

}catch (\Exception $exception){
    echo $exception->getMessage();
}