<?php
ini_set("display_errors", 1);

use Seerbit\Client;
use Seerbit\SeerbitException;
use Seerbit\Service\Account\AccountService;
require __DIR__ . '/../../../vendor/autoload.php';

try{
    $token ="pCEdKBei+5OLwaCamMlyct9dtHGFUyT35MVQZ5rYaQ5e6Eoj1amt/25WK8ZCWqN4ZPQlgar953PgHorH1RUoAJB6ZK5k5d+yAjmN0EcYpDSDQeEMMZuvUHZVXcXHwRyW";
    //Instantiate SeerBit Client
    $client = new Client();
    $client->setToken($token);
    //Configure SeerBit Client
    $client->setEnvironment(\Seerbit\Environment::LIVE);
    $client->setPublicKey("SBTESTPUBK_PjQ5dFOi522L383MlsQYUMAe6cZYviTF");

    //Instantiate Account Service
    $service =  New AccountService($client,$token);
    $uuid = bin2hex(random_bytes(6));
    $transaction_ref = strtoupper(trim($uuid));

    $json = '{
	"linkingReference":"F123500031595153273381",
	"otp":"00234242"
        }';

    $payload = json_decode($json, true);
    $payload['paymentReference'] = $transaction_ref;

    $transaction = $service->Validate($payload);

    header('Content-Type: application/json');
    echo($transaction->toJson());

}catch (SeerbitException $exception){
    echo $exception->getMessage();
}