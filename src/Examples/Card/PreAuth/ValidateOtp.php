<?php
ini_set("display_errors", 1);

use Seerbit\Client;
use Seerbit\Service\Card\CardService;

require __DIR__ . '/../../../vendor/autoload.php';

try {
    $token ="pCEdKBei+5OLwaCamMlyct9dtHGFUyT35MVQZ5rYaQ5e6Eoj1amt/25WK8ZCWqN4ZPQlgar953PgHorH1RUoAJB6ZK5k5d+yAjmN0EcYpDSDQeEMMZuvUHZVXcXHwRyW";
    //Instantiate SeerBit Client
    $client = new Client();
    $client->setToken($token);
    //Configure SeerBit Client
    $client->setEnvironment(\Seerbit\Environment::LIVE);
    $client->setAuthType(\Seerbit\AuthType::BEARER);

    //PRODUCTION CREDENTIALS
    $client->setPublicKey("SBTESTPUBK_PjQ5dFOi522L383MlsQYUMAe6cZYviTF");
    $client->setTimeout(20);//OPTIONAL

    //Instantiate Card Service
    $card_service =  New CardService($client);

    //Build OTP PayLoad
     $json = '{
     "linkingReference":"F123500031595153273381",
        "otp":"00234242"
     }';

     //Decode to associated array
     $payload = json_decode($json, true);

        //Validate OTP
        $transaction = $card_service->ValidateOtp($payload);
    header('Content-Type: application/json');
    echo($transaction->toJson());

}catch (\Exception $exception){
    echo $exception->getMessage();
}