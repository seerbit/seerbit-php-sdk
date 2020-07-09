<?php
ini_set("display_errors", 1);

use Seerbit\Client;
use Seerbit\Service\Authenticate;
use Seerbit\Service\Card\CardService;

require __DIR__ . '/../../../vendor/autoload.php';

try {
    $token ="pCEdKBei+5OLwaCamMlyct9dtHGFUyT35MVQZ5rYaQ5e6Eoj1amt/25WK8ZCWqN4ZPQlgar953PgHorH1RUoAJB6ZK5k5d+yAjmN0EcYpDSDQeEMMZuvUHZVXcXHwRyW";
    //Instantiate SeerBit Client
    $client = new Client();
    $client->setToken($token);
    //Configure SeerBit Client
    $client->setEnvironment(\Seerbit\Environment::LIVE);

    //PRODUCTION CREDENTIALS
    $client->setPublicKey("PUBLIC KEY");
    $client->setTimeout(20);//OPTIONAL

        //Instantiate Card Service
        $card_service =  New CardService($client);

        //Build OTP PayLoad
        $otp_json = '{
        "transaction":{
        "linkingreference":"F736308021578652945922",
        "otp":"410303"
        }
           }';

        //Decode to associated array
        $payload = json_decode($otp_json, true);

        //Validate OTP
        $transaction = $card_service->ValidateOtp($payload);
        echo($transaction->toJson());


}catch (\Exception $exception){
    echo $exception->getMessage();
}