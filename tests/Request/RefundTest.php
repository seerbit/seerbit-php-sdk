<?php


namespace Seerbit\Request;


use PHPUnit\Framework\TestCase;
use Seerbit\Client;
use Seerbit\SeerbitException;
use Seerbit\Service\MerchantAuthentication;
use Seerbit\Service\Refund\RefundService;

class RefundTest extends TestCase
{


    public function testRefundsList(){
        $client = new Client();
        try {
            $client->setEnvironment(\Seerbit\Environment::LIVE);
        } catch (SeerbitException $e) {
        }
        $client->setUsername("victorighalo@gmail.com");
        $client->setPassword("WISdom@1");

        //Instantiate Authentication Service
        $authService = new MerchantAuthentication($client);

        //Get Auth
        $auth = $authService->Auth();

        //Get Auth Data
        $auth_data= $auth->toArray();

        //Test has token key
        $this->assertArrayHasKey("token",$auth_data);

        //Get Auth Token
        $auth_token= $auth->getToken();

        $refund_service =  New RefundService($client, $auth_token);

        $all_refunds = $refund_service->all("00000013");

        $this->assertArrayHasKey("payload",$all_refunds->toArray());

        $this->assertNotNull($refund_service->toArray()['payload']);
        $this->assertEquals("00",$refund_service->toArray()['responseCode']);
    }

    public function testFindSingleRefund(){
        $client = new Client();
        try {
            $client->setEnvironment(\Seerbit\Environment::LIVE);
        } catch (SeerbitException $e) {
        }
        $client->setUsername("victorighalo@gmail.com");
        $client->setPassword("WISdom@1");

        //Instantiate Authentication Service
        $authService = new MerchantAuthentication($client);

        //Get Auth
        $auth = $authService->Auth();

        //Get Auth Data
        $auth_data= $auth->toArray();

        //Test has token key
        $this->assertArrayHasKey("token",$auth_data);

        //Get Auth Token
        $auth_token= $auth->getToken();

        $refund_service =  New RefundService($client, $auth_token);

        $single_refund = $refund_service->find("00000013", "4cdd3362c46e4e03bf9e28275c2c4f06");

        $this->assertNotNull($single_refund->toArray());
    }
}