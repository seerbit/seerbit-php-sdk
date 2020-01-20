<?php
ini_set("display_errors", 1);


use Seerbit\Client;
use Seerbit\Service\Authenticate;
use Seerbit\Service\Account\AccountService;

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
        //Instantiate Account Service
        $accountService = new AccountService($client, $card_auth_token);
        $uuid = bin2hex(random_bytes(6));
        $transaction_ref = strtoupper(trim($uuid));

        $json = '{   
        "fullname":"Brown Steve",
        "email":"sbtest@mailinator.com",
        "mobile":"08067238238283",
        "channelType":"ACCOUNT",
        "deviceType":"Samsung S10",
        "sourceIP":"1.0.1.0",
        "type":"3DSECURE",
        "currency": "NGN",
        "description": "Test Transaction",
        "country": "NG",
        "fee": "1.00",
        "amount": "500.00",
        "clientappcode":"app1",
        "callbackurl":"http://testing-test.surge.sh",
        "redirecturl":"http://bc-design.surge.sh",
        "account":{
            "sender":"1234567890",
            "name":"Moses Victor",
            "senderbankcode":"215",
            "senderdateofbirth":"09122020",
            "bvn":"12341741835"
            }
        }';

        $payload = json_decode($json, true);
        $payload['reference'] = $transaction_ref;

        //Execute transaction
        $transaction = $accountService->Authorize($payload);
        echo($transaction->toJson());

    }else{
        echo 'Authentication failed';
    }


}catch (\Exception $exception){
    echo $exception->getMessage();
}