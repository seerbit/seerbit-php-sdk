<?php
ini_set("display_errors", 1);

use Seerbit\Client;
use Seerbit\Service\Order\OrderService;

require __DIR__ . '/../../../vendor/autoload.php';

try {
    $token = "1KWLzpZkWaoXO9AN4qweKwqLjGcQSNt8kjeVjsdTG4lPlwg6sTvpVAay2RA7hoCEzHPkIQa+MNfDepx4VBr5JMgLb5Q5anq9XoN2pXU850bumqBWFVw1T1ZW5w8N+Sq/";
    //Instantiate SeerBit Client
    $client = new Client();
    $client->setToken($token);
    //Configure SeerBit Client
    $client->setEnvironment(\Seerbit\Environment::LIVE);

    //SETUP CREDENTIALS
    $client->setPublicKey("SBTESTPUBK_p8GqvFSFNCBahSJinczKd9aIPoRUZfda");
    $client->setSecretKey("SBTESTSECK_kFgKytQK1KSvbR616rUMqNYOUedK3Btm5igZgxaZ");

    $uuid = bin2hex(random_bytes(6));
    $transaction_ref = strtoupper(trim($uuid));

    //Instantiate Mobile Money Service
    $service = New OrderService($client);

    //Build PayLoad
    $data = '{
        "email":"johndoe@gmail.com",
		"fullName":"John Doe",
		"orderType":"BULK_BULK",
		"callbackUrl":"https://yourdomain.com",
		"country":"NG",
		"currency":"NGN",
		"amount":"1400",
		"orders":[
			{
			"orderId":"22S789420214623",
			"currency":"NGN",
			"amount":"500.00",
			"productId":"fruits",
			"productDescription":"mango"
			},
			{
			"orderId":"1a3sa82748272556947",
			"currency":"NGN",
			"amount":"900.00",
			"productId":"fruits",
			"productDescription":"orange"
			}
		]}';

    //Decode to associated array
    $payload = json_decode($data, true);
    $payload['paymentReference'] = $transaction_ref;

    $transaction = $service->Create($payload);

    header('Content-Type: application/json');
    echo($transaction->toJson());


} catch (\Exception $exception) {
    echo $exception->getMessage();
}