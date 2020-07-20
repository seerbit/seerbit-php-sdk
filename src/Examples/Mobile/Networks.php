<?php
ini_set("display_errors", 1);

use Seerbit\Client;
use Seerbit\SeerbitException;
use Seerbit\Service\Mobile\MobileService;

require __DIR__ . '/../../../vendor/autoload.php';

try {
    $token = "pCEdKBei+5OLwaCamMlyct9dtHGFUyT35MVQZ5rYaQ5e6Eoj1amt/25WK8ZCWqN4ZPQlgar953PgHorH1RUoAJB6ZK5k5d+yAjmN0EcYpDSDQeEMMZuvUHZVXcXHwRyW";
    //Instantiate SeerBit Client
    $client = new Client();
    $client->setToken($token);
    //Configure SeerBit Client
    $client->setEnvironment(\Seerbit\Environment::LIVE);

    //SETUP CREDENTIALS
    $client->setPublicKey("SBTESTPUBK_PjQ5dFOi522L383MlsQYUMAe6cZYviTF");

    //Instantiate Mobile Money Service
    $service = New MobileService($client,$token);

    $result = $service->Networks();

    header('Content-Type: application/json');
    echo($result->toJson());

} catch (SeerbitException $exception) {
    echo $exception->getMessage();
}