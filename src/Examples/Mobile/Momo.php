<?php
ini_set("display_errors", 1);

use Seerbit\Client;
use Seerbit\Service\Mobile\MobileService;

require __DIR__ . '/../../../vendor/autoload.php';

try {
    $token = "pCEdKBei+5OLwaCamMlyct9dtHGFUyT35MVQZ5rYaQ5e6Eoj1amt/25WK8ZCWqN4ZPQlgar953PgHorH1RUoAJB6ZK5k5d+yAjmN0EcYpDSDQeEMMZuvUHZVXcXHwRyW";
    //Instantiate SeerBit Client
    $client = new Client();
    $client->setToken($token);
    //Configure SeerBit Client
    $client->setEnvironment(\Seerbit\Environment::LIVE);

    //PRODUCTION CREDENTIALS
    $client->setPublicKey("SBTESTPUBK_PjQ5dFOi522L383MlsQYUMAe6cZYviTF");
    $uuid = bin2hex(random_bytes(6));
    $transaction_ref = strtoupper(trim($uuid));
    //Instantiate Mobile Money Service
    $momo_service = New MobileService($client);

    //Build OTP PayLoad
    $otp_json = '{
        "fullName":"John Wick",
	  "email":"johndoe@gmail.com",
	  "mobileNumber":"08022343345",
    "deviceType":"nokia 3310",
    "sourceIP":"1.0.1.0",
    "currency": "NGN",
    "productDescription": "snacks",
    "country": "UG",
    "fee": "1.00",
    "amount": "10.01",
    "productId":"grocery",
    "paymentType":"MOMO"
           }';

    //Decode to associated array
    $payload = json_decode($otp_json, true);
    $payload['paymentReference'] = $transaction_ref;

    $transaction = $momo_service->Momo($payload);
    echo($transaction->toJson());


} catch (\Exception $exception) {
    echo $exception->getMessage();
}