<?php
ini_set("display_errors", 1);

use Seerbit\Client;
use Seerbit\SeerbitException;
use Seerbit\Service\Account\AccountService;
require __DIR__ . '/../../../vendor/autoload.php';

try{
    $token = "1KWLzpZkWaoXO9AN4qweKwqLjGcQSNt8kjeVjsdTG4lPlwg6sTvpVAay2RA7hoCEzHPkIQa+MNfDepx4VBr5JMgLb5Q5anq9XoN2pXU850bumqBWFVw1T1ZW5w8N+Sq/";
    //Instantiate SeerBit Client
    $client = new Client();
    $client->setToken($token);
    $client->setEnvironment(\Seerbit\Environment::LIVE);
    $client->setAuthType(\Seerbit\AuthType::BEARER);

    //SETUP CREDENTIALS
    $client->setPublicKey("SBTESTPUBK_p8GqvFSFNCBahSJinczKd9aIPoRUZfda");
    $client->setSecretKey("SBTESTSECK_kFgKytQK1KSvbR616rUMqNYOUedK3Btm5igZgxaZ");

    $card_service =  New AccountService($client);

    $json = '{
        "linkingReference":"F121934771596484765108",
        "otp":"00234242"
        }';

    $payload = json_decode($json, true);
    $transaction = $card_service->Validate($payload);

    header('Content-Type: application/json');
    echo($transaction->toJson());

}catch (SeerbitException $exception){
    echo $exception->getMessage();
}