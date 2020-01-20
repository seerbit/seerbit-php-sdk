<?php
ini_set("display_errors", 1);

use Seerbit\Client;
use Seerbit\Service\MerchantAuthentication;
use Seerbit\Service\Refund\RefundService;

require __DIR__ . '/../../vendor/autoload.php';

try {
    $client = new Client();
    $client->setEnvironment(\Seerbit\Environment::LIVE);
    $client->setUsername("MERCHANT EMAIL");
    $client->setPassword("MERCHANT PASSWORD");
    $client->setTimeout(20);

    $authService = new MerchantAuthentication($client);

    $token = $authService->Auth()->getToken();
    if ($token){
        $refund_service =  New RefundService($client, $token);
        $refund_payload = [
            "type" => \Seerbit\RefundType::PARTIAL,
	        "amount"=> "10",
            "transactionRef" => "PJQ5D1577092649489",
	        "description" => "Buyer genuinely didn’t receive value and refund will be sent"
        ];
        $all_refunds = $refund_service->refund("BUSINESS ID",$refund_payload);
//        $all_refunds = $refund_service->all("00000013");
//        $all_refunds = $refund_service->find("00000013", "4cdd3362c46e4e03bf9e28275c2c4f06");
        echo($all_refunds->toJson());
    }else{
        echo 'Authentication failed';
    }


}catch (\Exception $exception){
    echo $exception->getMessage();
}