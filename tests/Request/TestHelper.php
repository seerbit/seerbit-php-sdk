<?php

namespace Seerbit\Request;

use Seerbit\Client;


trait TestHelper
{

    protected static $secretKey = SEERBIT_SECRET_KEY;
    
    protected static $publiKey = SEERBIT_PUBLIC_KEY;

    protected static $token = SEERBIT_TOKEN;


    public static function SeerBitServiceBasic(){
        $client = new Client();
        $client->setLoggerPath(dirname(__FILE__));
        $client->setToken(self::$token);
        //Configure SeerBit Client
        $client->setEnvironment(\Seerbit\Environment::LIVE);
        $client->setAuthType("Basic");

        //SETUP CREDENTIALS
        $client->setPublicKey(self::$publiKey);
        $client->setSecretKey(self::$secretKey);
        return $client;
    }

    public static function SeerBitServiceBearer(){
        $client = new Client();
        $client->setLoggerPath(dirname(__FILE__));
        $client->setToken(self::$token);
        //Configure SeerBit Client
        $client->setEnvironment(\Seerbit\Environment::LIVE);
        $client->setAuthType("Bearer");

        //SETUP CREDENTIALS
        $client->setPublicKey(self::$publiKey);
        $client->setSecretKey(self::$secretKey);
        return $client;
    }

}

