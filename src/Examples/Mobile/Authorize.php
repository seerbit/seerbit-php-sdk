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
    $client->setAuthType(\Seerbit\AuthType::BEARER);

    //SETUP CREDENTIALS
    $client->setPublicKey("SBTESTPUBK_PjQ5dFOi522L383MlsQYUMAe6cZYviTF");
    $uuid = bin2hex(random_bytes(6));
    $transaction_ref = strtoupper(trim($uuid));
    //Instantiate Mobile Money Service
    $service = New MobileService($client);

    //Build PayLoad
    $data =
    '{   
    "fullName":"john doe",
	"email":"johndoe@gmail.com",
	"mobileNumber":"08022343345",
    "currency": "GHS",
    "country": "GH",
    "network":"MTN",
    "amount": "10.01",
    "paymentType":"MOMO"
    }';

    //Decode to associated array
    $payload = json_decode($data, true);
    $payload['paymentReference'] = $transaction_ref;

    $transaction = $service->Authorize($payload);

    header('Content-Type: application/json');
    echo($transaction->toJson());

} catch (\Exception $exception) {
    echo $exception->getMessage();
}