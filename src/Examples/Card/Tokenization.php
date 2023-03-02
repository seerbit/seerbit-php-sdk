<?php

ini_set("display_errors", 1);

use Seerbit\Client;
use Seerbit\Service\Card\TokenizeService;
require_once 'vendor/autoload.php';

class Tokenization
{
    
    public function CreateToken(){
        try{
            //Instantiate SeerBit Client
            $client = new Client();
        
            //Configure SeerBit Client
            $client->setPublicKey("MERCHANT_PUBLIC_KEY");
        
            $service =  New TokenizeService($client);

            $json = '{
                "amount": "100.00",
                "fullName": "Anonymous Shopper",
                "mobileNumber": "03447522256",
                "currency": "NGN",
                "country": "NG",
                "email": "anonshopper@gmail.com",
                "paymentType": "CARD",
                "cardNumber": "6280511000000095",
                "expiryMonth": "12",
                "expiryYear": "26",
                "cvv": "123",
                "pin": "1234"
                }';
        
                $payload = json_decode($json, true);
                $uuid = bin2hex(random_bytes(6));
                $transaction_ref = strtoupper(trim($uuid));
                $payload['paymentReference'] = $transaction_ref;
                $payload['tokenize'] = true;
        
                $transaction = $service->CreateToken($payload);
                echo $transaction->toJson();
        
        }catch (\Exception $exception){
            echo $exception->getMessage();
        }
    }

    public function GetToken($reference){
        try{
            //Instantiate SeerBit Client
            $client = new Client();
        
            //Configure SeerBit Client
            $client->setAuthType(Seerbit\AuthType::BEARER);
            $client->setPublicKey("PLUBLIC_KEY");
            $client->setSecretKey("SECRET_KEY");

            $service =  New TokenizeService($client);
            
            $transaction_reference = $reference; 
            // the reference is the same reference used when generating a token
            $transaction = $service->GetToken($transaction_reference);
            echo $transaction->toJson();
        }catch (\Exception $exception){
            echo $exception->getMessage();
        }
    }

    public function ChargeToken($authorizationCode){
        try{
            //Instantiate SeerBit Client
            $client = new Client();
        
            //Configure SeerBit Client
            $client->setAuthType(Seerbit\AuthType::BEARER);
            $client->setPublicKey("PLUBLIC_KEY");
            $client->setSecretKey("SECRET_KEY");

            $service =  New TokenizeService($client);
        
            $uuid = bin2hex(random_bytes(6));
            $transaction_ref = strtoupper(trim($uuid));
            $charge_token_payload = [
                'paymentReference' => $transaction_ref, 
                "authorizationCode" => $authorizationCode, 
                "amount" => "100.00"
            ];
            //$authorizationCode is gotten from the get token service
        
            $transaction = $service->ChargeToken($charge_token_payload);
            echo $transaction->toJson();
        }catch (\Exception $exception){
            echo $exception->getMessage();
        }
    }

    public function ChargeTokenBulk(){
        try{
            //Instantiate SeerBit Client
            $client = new Client();
        
            //Configure SeerBit Client
            $client->setAuthType(Seerbit\AuthType::BEARER);
            $client->setPublicKey("PLUBLIC_KEY");
            $client->setSecretKey("SECRET_KEY");

            $service =  New TokenizeService($client);
        
            $uuid = bin2hex(random_bytes(6));
            $transaction_ref = strtoupper(trim($uuid));
            $charge_token_payload = [
               (object)['paymentReference' => $transaction_ref, 
               "authorizationCode" => "", 
               "amount" => "100.00"],
               (object)['paymentReference' => $transaction_ref, 
               "authorizationCode" => "", 
               "amount" => "100.00"]
            ];
        
            $transaction = $service->ChargeTokenBulk($charge_token_payload);
            echo $transaction->toJson();
        }catch (\Exception $exception){
            echo $exception->getMessage();
        }
    }
}

