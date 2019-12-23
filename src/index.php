<?php
ini_set("display_errors", 1);
ini_set("log_errors", 1);
ini_set("error_log", dirname(__FILE__)."/errors.txt");
use Seerbit\Client;
use Seerbit\Service\Authenticate;
use Seerbit\Service\Card;
use Seerbit\Service\Transaction;
use Seerbit\Service\Account;


require __DIR__.'/../vendor/autoload.php';


try {
$client = new Client();
$client->setEnvironment(\Seerbit\Environment::LIVE);
$client->setPublicKey("SBTESTPUBK_PjQ5dFOi522L383MlsQYUMAe6cZYviTF");
$client->setPrivateKey("SBTESTSECK_9CDyHxbubCHnqJba5iiIytD5TLyySiHNvBY1UhPX");
$client->setTimeout(20);


$authService = new Authenticate($client);

$token = $authService->GetToken()->toArray();

//$cardService = new Card($client, $token['access_token']);
//$transactionService = new Transaction($client, $token['access_token']);
//$accountService = new Account($client, $token['access_token']);
$cardService = new Card($client, $token['access_token']);

$uuid = bin2hex(random_bytes(6));
$trans_id = strtoupper(trim($uuid));

//$json = '{
//  "fullname":"Aminu Grod",
//  "email":"kolawolesam@gmail.com",
//  "mobile":"03200000",
//  "channelType":"ACCOUNT",
//  "deviceType":"nokia 33",
//  "sourceIP":"1.0.1.0",
//  "type":"3DSECURE",
//  "currency": "NGN",
//  "description": "pilot test account",
//  "country": "NG",
//  "fee": "1.00",
//  "amount": "150.00",
//  "clientappcode":"app1",
//  "callbackurl":"http://testing-test.surge.sh",
//  "redirecturl":"http://bc-design.surge.sh",
//  "account":{
//  "sender":"0038721434",
//    "name":"AYODELE PRAISE EREMA",
//    "senderbankcode":"214",
//    "senderdateofbirth":"04011984",
//    "bvn":"22141741835"
//    }
//}';
//
//    $params = json_decode($json, true);
//    $params["reference"] = $trans_id;
//
//    $result = $accountService->Authorize($params)->toJson();

//$json = '{
//"fullname":"Kolawole ma7ry",
//"email":"paulossp32@gmail.com",
//"mobile":"03200067990",
//"public_key":"SBTESTPUBK_PjQ5dFOi522L383MlsQYUMAe6cZYviTF",
//"channelType":"Verve",
//"deviceType":"nokia 3310",
//"sourceIP":"1.0.1.0",
//"currency": "NGN",
//"description": "test",
//"country": "NG",
//"fee": "1.00",
//"amount": "70.01",
//"productId":"fjngklsvis",
//"clientappcode":"app1",
//"callbackurl":"https://checkout.seerbit.com",
//"redirecturl":"https://checkout.seerbit.com",
//"retry":"",
//"card":{
//"number":"5123450000000008",
//"cvv":"100",
//"expirymonth":"05",
//"expiryyear":"21",
//"pin":"0808"
//}
//}
//';

$otp_json = '{
  "transaction":{
    "linkingreference":"F771181731576846159311",
    "otp":"458504"
  }
  }
  ';

$params = json_decode($otp_json, true);


$result = $cardService->ValidateOtp($params)->toJson();
echo($result);

}catch (\Exception $exception){
    echo $exception->getMessage();
}