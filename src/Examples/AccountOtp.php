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

    //PRODUCTION CREDENTIALS
    $client->setPublicKey("PUBLIC KEY");
    $client->setPrivateKey("PRIVATE KEY");
    $client->setTimeout(20);//OPTIONAL

    //Instantiate Authentication Service
    $authService = new Authenticate($client);

    //Get Auth Token
    $card_auth_token = $authService->Auth()->getToken();

    if ($card_auth_token){
        //Instantiate Account Service
        $accountService = new AccountService($client, $card_auth_token);

        //Build OTP PayLoad
        $otp_json = '{
        "linkingreference":"2399293JSNBJBSFSDFSDS",
        "otp":"123456"
        }';

        $payload = json_decode($otp_json, true);

        //Execute transaction
        $transaction = $accountService->Validate($payload);
        echo($transaction->toJson());

    }else{
        echo 'Authentication failed';
    }


}catch (\Exception $exception){
    echo $exception->getMessage();
}