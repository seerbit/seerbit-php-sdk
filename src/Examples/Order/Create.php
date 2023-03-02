<?php
ini_set("display_errors", 1);

use Seerbit\Client;
use Seerbit\Service\Order\OrderService;

require __DIR__ . '/../../../vendor/autoload.php';

try {
    $token = "MERCHANT_TOKEN";
    //Instantiate SeerBit Client
    $client = new Client();

    //Configure SeerBit Client
    $client->setToken($token);

    //SETUP CREDENTIALS
    $client->setPublicKey("MERCHANT_PUBLIC_KEY");
    $client->setSecretKey("MERCHANT_SECRET_KEY");

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