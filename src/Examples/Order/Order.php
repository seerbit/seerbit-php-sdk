<?php
ini_set("display_errors", 1);

use Seerbit\Client;
use Seerbit\Service\Order\OrderService;

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
    $uuid = bin2hex(random_bytes(6));
    $transaction_ref = strtoupper(trim($uuid));
    //Instantiate Mobile Money Service
    $service = New OrderService($client);

    //Build PayLoad
    $data = '{
        "email":"johndoe@gmail.com",
		"fullName":"John Doe",
		"orderType":"BULK_BULK",
		"mobileNumber":"08000000001",
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

    $transaction = $service->Order($payload);
    echo($transaction->toJson());


} catch (\Exception $exception) {
    echo $exception->getMessage();
}