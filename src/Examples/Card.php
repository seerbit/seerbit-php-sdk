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

    //PRODUCTION CREDENTIALS
    $client->setPublicKey("PUBLIC KEY");
    $client->setPrivateKey("PRIVATE KEY");
    $client->setTimeout(20);//OPTIONAL

    //Instantiate Authentication Service
    $authService = new Authenticate($client);

    //Get Auth Token
    $card_auth_token = $authService->Auth()->getToken();


    if ($card_auth_token){
        //Instantiate Card Service
        $card_service =  New CardService($client, $card_auth_token);
        $uuid = bin2hex(random_bytes(6));
        $transaction_ref = strtoupper(trim($uuid));

        $json = '{
          "fullname":"Aminu Grod",
          "email":"kolawolesam@gmail.com",
          "mobile":"03200000",
          "channelType":"mastercard",
          "type":"3DSECURE",
          "deviceType":"samsung s3",
          "sourceIP":"1.0.0.1",
          "currency": "NGN",
          "description": "Integration Transaction",
          "country": "NG",
          "fee": "1.00",
          "amount": "250.00",
          "tranref":"",
          "clientappcode":"app1",
          "callbackurl":"http://testing-test.surge.sh",
          "redirecturl":"http://bc-design.surge.sh",
          "card":{
          "number":"5061040201593455366",
            "cvv":"100",
            "expirymonth":"05",
            "expiryyear":"21",
            "pin": "8319"
            }
        }';

        $payload = json_decode($json, true);
        $payload['tranref'] = $transaction_ref;


//        $otp_json = '{
//        "transaction":{
//        "linkingreference":"F771181731576846159311",
//        "otp":"458504"
//        }
//           }
//        ';


        $transaction = $card_service->Authorize($payload);
//        $transaction = $card_service->ValidateOtp(json_decode($otp_json, true));
        echo($transaction->toJson());

    }else{
        echo 'Authentication failed';
    }


}catch (\Exception $exception){
    echo $exception->getMessage();
}