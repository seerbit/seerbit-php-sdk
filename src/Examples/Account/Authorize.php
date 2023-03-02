<?php
ini_set("display_errors", 1);

use Seerbit\Client;
use Seerbit\Service\Account\AccountService;
require __DIR__ . '/../../../vendor/autoload.php';

try{
    $token = "MERCHANT_TOKEN";
    //Instantiate SeerBit Client
    $client = new Client();

    //Configure SeerBit Client
    $client->setToken($token);

    //SETUP CREDENTIALS
    $client->setPublicKey("MERCHANT_PUBLIC_KEY");

    $card_service =  New AccountService($client);
    $uuid = bin2hex(random_bytes(6));
    $transaction_ref = strtoupper(trim($uuid));

    $json = '{
        "amount":"1000.00",
        "accountName":"Customer Bank Account Name",
        "accountNumber":"1234567890",
        "bankCode":"033",
        "currency":"NGN",
        "country":"NG",
        "email":"customer@email.com"
        }';

    $payload = json_decode($json, true);
    $payload['paymentReference'] = $transaction_ref;
    $transaction = $card_service->Authorize($payload);

    echo($transaction->toJson());

}catch (\Exception $exception){
    echo $exception->getMessage();
}