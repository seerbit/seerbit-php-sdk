<?php
ini_set("display_errors", 1);

use Seerbit\Client;
use Seerbit\Service\MerchantAuthentication;
use Seerbit\Service\Dispute\DisputeService;

require __DIR__ . '/../../vendor/autoload.php';

try {
    $client = new Client();
    $client->setEnvironment(\Seerbit\Environment::LIVE);
    $client->setUsername("victorighalo@gmail.com");
    $client->setPassword("WISdom@1");
    $client->setTimeout(20);

    $authService = new MerchantAuthentication($client);

    $token = $authService->Auth()->getToken();
    if ($token){
        $dispute_service =  New DisputeService($client, $token);
        $dispute_payload = [
            "customer_email" => "tosyngy@rocketmail.com",
            "transaction_ref" => "PUBK_PJQ5D1576611860644",
            "amount" => "1",
            "evidence" =>  (object)[
                "message" => "Buyer didnt receive value",
                "images" => ["image" => "image.png"]
                ]
            ];

        $all = $dispute_service->all("00000013");
        echo($all->toJson());
        
    }else{
        echo 'Authentication failed';
    }


}catch (\Exception $exception){
    echo $exception->getMessage();
}