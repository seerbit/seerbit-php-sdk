<?php

use PHPUnit\Framework\TestCase;
use Seerbit\Client;

class ConfigurationTest extends TestCase
{

    public function testStartsEntryClass(){
        $client = new Client();
        $this->assertEquals("Seerbit\Client", get_class($client));
    }


    public function testSetKeys(){
        $client = new Client();
        $client->setPrivateKey("MERCHANT_SECRET_KEY");
        $client->setPublicKey("MERCHANT_PUBLIC_KEY");

        $this->assertEquals("MERCHANT_SECRET_KEY", $client->getPrivateKey());
        $this->assertEquals("MERCHANT_PUBLIC_KEY", $client->getPublicKey());
    }


    public function testSetTimeout(){
        $client = new Client();
        $client->setTimeout(60);

        $this->assertEquals(60, $client->getTimeout());
    }

    public function testSetEnvironment(){
        $client = new Client();
        $client->setEnvironment(\Seerbit\Environment::LIVE);
        $this->assertEquals("live", $client->getEnvironment());

        $client->setEnvironment(\Seerbit\Environment::PILOT);
        $this->assertEquals("pilot", $client->getEnvironment());
    }
}