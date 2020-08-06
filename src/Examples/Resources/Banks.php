<?php
ini_set("display_errors", 1);

use Seerbit\Client;
use Seerbit\Service\Resource\ResourceService;

require __DIR__ . '/../../../vendor/autoload.php';

try{
    $token = "pCEdKBei+5OLwaCamMlyct9dtHGFUyT35MVQZ5rYaQ5e6Eoj1amt/25WK8ZCWqN4ZPQlgar953PgHorH1RUoAJB6ZK5k5d+yAjmN0EcYpDSDQeEMMZuvUHZVXcXHwRyW";
    //Instantiate SeerBit Client
    $client = new Client();
    $client->setToken($token);
    //Configure SeerBit Client
    $client->setEnvironment(\Seerbit\Environment::LIVE);
    $client->setAuthType(\Seerbit\AuthType::BEARER);

    //SETUP CREDENTIALS
    $client->setPublicKey("SBTESTPUBK_p8GqvFSFNCBahSJinczKd9aIPoRUZfda");
    $client->setSecretKey("SBTESTSECK_kFgKytQK1KSvbR616rUMqNYOUedK3Btm5igZgxaZ");

    //Instantiate Resource Service
    $card_service =  New ResourceService($client);

    $transaction = $card_service->GetBankList();

    header('Content-Type: application/json');
    echo($transaction->toJson());

}catch (\Exception $exception){
    echo $exception->getMessage();
}