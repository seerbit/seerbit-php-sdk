<?php
ini_set("display_errors", 1);

use Seerbit\Client;
use Seerbit\Service\Authenticate;
use Seerbit\Service\Card\CardService;
require __DIR__ . '/../../../vendor/autoload.php';

try{
    $token ="pCEdKBei+5OLwaCamMlyct9dtHGFUyT35MVQZ5rYaQ5e6Eoj1amt/25WK8ZCWqN4ZPQlgar953PgHorH1RUoAJB6ZK5k5d+yAjmN0EcYpDSDQeEMMZuvUHZVXcXHwRyW";
    //Instantiate SeerBit Client
    $client = new Client();
    $client->setToken($token);
    //Configure SeerBit Client
    $client->setEnvironment(\Seerbit\Environment::LIVE);
    $client->setPublicKey("SBTESTPUBK_PjQ5dFOi522L383MlsQYUMAe6cZYviTF");


        //Instantiate Card Service
        $card_service =  New CardService($client);
        $uuid = bin2hex(random_bytes(6));
        $transaction_ref = strtoupper(trim($uuid));

        $json = '{
        "cardNumber":"5123450000000008",
        "cvv":"100",
        "expiryMonth":"05",
        "expiryYear":"21",
        "currency":"KES",
        "country":"KE",
        "amount":"100.00",
        "email":"johndoe@gmail.com",
        "fullName":"john doe"
        }';

        $payload = json_decode($json, true);
        $payload['paymentReference'] = $transaction_ref;

        $transaction = $card_service->Authorize($payload);

        echo($transaction->toJson());



}catch (\Exception $exception){
    echo $exception->getMessage();
}