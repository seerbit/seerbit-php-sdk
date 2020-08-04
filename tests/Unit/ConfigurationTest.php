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
        $client->setPrivateKey("SBSECK_DWZ6LTTJW78LFT1LIXNBFDFIMBJJ3NLASDTCO8IP");
        $client->setPublicKey("SBPUBK_ES14RXZQ2IRICCPUYWHFC8BJNTHK1IML");

        $this->assertEquals("SBSECK_DWZ6LTTJW78LFT1LIXNBFDFIMBJJ3NLASDTCO8IP", $client->getPrivateKey());
        $this->assertEquals("SBPUBK_ES14RXZQ2IRICCPUYWHFC8BJNTHK1IML", $client->getPublicKey());
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