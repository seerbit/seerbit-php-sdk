<?php
ini_set("display_errors", 1);

use Seerbit\Client;
use Seerbit\Service\Resource\ResourceService;

require __DIR__ . '/../../../vendor/autoload.php';

try{
    //Instantiate SeerBit Client
    $client = new Client();
    //Configure SeerBit Client
    $client->setEnvironment(\Seerbit\Environment::LIVE);
    $client->setAuthType(\Seerbit\AuthType::BEARER);
    $client->setPublicKey("SBTESTPUBK_PjQ5dFOi522L383MlsQYUMAe6cZYviTF");

    //Instantiate Resource Service
    $card_service =  New ResourceService($client);

    $transaction = $card_service->GetBankList();

    header('Content-Type: application/json');
    echo($transaction->toJson());

}catch (\Exception $exception){
    echo $exception->getMessage();
}