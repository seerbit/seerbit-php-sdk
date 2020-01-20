<?php
ini_set("display_errors", 1);

use Seerbit\Client;
use Seerbit\Service\Authenticate;
use Seerbit\Service\Card\CardService;

require __DIR__ . '/../../vendor/autoload.php';

try {

    //Instantiate SeerBit Client
    $client = new Client();

    //Configure SeerBit Client
    $client->setEnvironment(\Seerbit\Environment::LIVE);

    //PILOT CREDENTIALS
//    $client->setPublicKey("SBPUBK_ES14RXZQ2IRICCPUYWHFC8BJNTHK1IML");
//    $client->setPrivateKey("SBSECK_DWZ6LTTJW78LFT1LIXNBFDFIMBJJ3NLASDTCO8IP");

    //PRODUCTION CREDENTIALS
//    $client->setPublicKey("SBTESTPUBK_7QvjzOsvnWVKjDosScLHmlhr4rowXaQG");
//    $client->setPrivateKey("SBTESTSECK_ZFDCdIpgm0aidsNCA5X36zTrlsOs9SsGPtHWDLF8");

    //PRODUCTION CREDENTIALS
    $client->setPublicKey("SBTESTPUBK_PjQ5dFOi522L383MlsQYUMAe6cZYviTF");
    $client->setPrivateKey("SBTESTSECK_9CDyHxbubCHnqJba5iiIytD5TLyySiHNvBY1UhPX");
    $client->setTimeout(20);

    //Instantiate Authentication Service
    $authService = new Authenticate($client);

    //Get Auth Token
    $card_auth_token = $authService->Auth()->getToken();

    if ($card_auth_token){
        //Instantiate Card Service
        $card_service =  New CardService($client, $card_auth_token);

        //Build OTP PayLoad
        $otp_json = '{
        "transaction":{
        "linkingreference":"F736308021578652945922",
        "otp":"410303"
        }
           }
        ';

        //Decode to associated array
        $payload = json_decode($otp_json, true);

        //Validate OTP
        $transaction = $card_service->ValidateOtp($payload);
        echo($transaction->toJson());

    }else{
        echo 'Authentication failed';
    }


}catch (\Exception $exception){
    echo $exception->getMessage();
}