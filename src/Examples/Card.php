<?php
ini_set("display_errors", 1);

use Seerbit\Client;
use Seerbit\Service\Authenticate;
use Seerbit\Service\Card\CardService;

require __DIR__ . '/../../vendor/autoload.php';

try {
    $client = new Client();
    $client->setEnvironment(\Seerbit\Environment::LIVE);
    $client->setPublicKey("SBTESTPUBK_PjQ5dFOi522L383MlsQYUMAe6cZYviTF");
    $client->setPrivateKey("SBTESTSECK_9CDyHxbubCHnqJba5iiIytD5TLyySiHNvBY1UhPX");
    $client->setTimeout(20);

    $authService = new Authenticate($client);

    $card_auth_token = $authService->Auth()->getToken();

    if ($card_auth_token){
        $card_service =  New CardService($client, $card_auth_token);
        $uuid = bin2hex(random_bytes(6));
        $trans_id = strtoupper(trim($uuid));

//        $json = '{
//          "fullname":"Aminu Grod",
//          "email":"kolawolesam@gmail.com",
//          "mobile":"03200000",
//          "channelType":"ACCOUNT",
//          "deviceType":"nokia 33",
//          "sourceIP":"1.0.1.0",
//          "type":"3DSECURE",
//          "currency": "NGN",
//          "description": "pilot test account",
//          "country": "NG",
//          "fee": "1.00",
//          "amount": "150.00",
//          "clientappcode":"app1",
//          "callbackurl":"http://testing-test.surge.sh",
//          "redirecturl":"http://bc-design.surge.sh",
//          "account":{
//          "sender":"0038721434",
//            "name":"AYODELE PRAISE EREMA",
//            "senderbankcode":"214",
//            "senderdateofbirth":"04011984",
//            "bvn":"22141741835"
//            }
//        }';

        $otp_json = '{
        "transaction":{
        "linkingreference":"F771181731576846159311",
        "otp":"458504"
        }
           }
        ';


//        $transaction = $card_service->Authorize(json_decode($json, true));
        $transaction = $card_service->ValidateOtp(json_decode($otp_json, true));
        echo($transaction->toJson());

    }else{
        echo 'Authentication failed';
    }


}catch (\Exception $exception){
    echo $exception->getMessage();
}