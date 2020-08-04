<?php
ini_set("display_errors", 1);

use Seerbit\Client;
use Seerbit\Service\Recurrent\RecurrentService;

require __DIR__ . '/../../../vendor/autoload.php';

try {
    $token = "pCEdKBei+5OLwaCamMlyct9dtHGFUyT35MVQZ5rYaQ5e6Eoj1amt/25WK8ZCWqN4ZPQlgar953PgHorH1RUoAJB6ZK5k5d+yAjmN0EcYpDSDQeEMMZuvUHZVXcXHwRyW";
    //Instantiate SeerBit Client
    $client = new Client();
    $client->setToken($token);
    //Configure SeerBit Client
    $client->setEnvironment(\Seerbit\Environment::LIVE);
    $client->setAuthType(\Seerbit\AuthType::BEARER);

    //SETUP CREDENTIALS
    $client->setPublicKey("SBTESTPUBK_PjQ5dFOi522L383MlsQYUMAe6cZYviTF");
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