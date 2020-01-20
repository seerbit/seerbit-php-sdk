<?php
ini_set("display_errors", 1);

use Seerbit\Client;
use Seerbit\Service\Authenticate;
use Seerbit\Service\Status\TransactionStatusService;

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
        $card_service =  New TransactionStatusService($client, $card_auth_token);

        $transaction_reference = "SKNKMKNKS8888";

        //Validate Transaction
        $transaction = $card_service->ValidateStatus($transaction_reference);
        echo($transaction->toJson());

    }else{
        echo 'Authentication failed';
    }


}catch (\Exception $exception){
    echo $exception->getMessage();
}