<?php


namespace Seerbit\Request;


use PHPUnit\Framework\TestCase;
use Seerbit\Client;
use Seerbit\SeerbitException;
use Seerbit\Service\Dispute\DisputeService;
use Seerbit\Service\MerchantAuthentication;

class DisputeTest extends TestCase
{

    public function testDisputesList(){
        $client = new Client();
        try {
            $client->setEnvironment(\Seerbit\Environment::LIVE);
        } catch (SeerbitException $e) {
        }
        $client->setUsername("okechukwu.diei2@mailinator.com");
        $client->setPassword("Centric@123");

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

        $dispute_service =  New DisputeService($client, $auth_token);

        $all_disputes = $dispute_service->all("00000063");

        $this->assertArrayHasKey("payload",$all_disputes->toArray());

        $this->assertNotNull($all_disputes->toArray()['payload']);
        $this->assertEquals("00",$all_disputes->toArray()['responseCode']);
    }


    public function testFindDispute(){
        $client = new Client();
        try {
            $client->setEnvironment(\Seerbit\Environment::LIVE);
        } catch (SeerbitException $e) {
        }
        $client->setUsername("okechukwu.diei2@mailinator.com");
        $client->setPassword("Centric@123");

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

        try {
            $dispute_service = New DisputeService($client, $auth_token);

            $all_disputes = $dispute_service->find("00000063", 5);

            $this->assertArrayHasKey("payload", $all_disputes->toArray());

            $this->assertNotNull($all_disputes->toArray()['payload']);
            $this->assertEquals("00", $all_disputes->toArray()['responseCode']);
        }catch (SeerbitException $e){

        }
    }

    public function testUpdateDispute(){
        $client = new Client();
        try {
            $client->setEnvironment(\Seerbit\Environment::LIVE);
        } catch (SeerbitException $e) {
        }
        $client->setUsername("okechukwu.diei2@mailinator.com");
        $client->setPassword("Centric@123");

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

        try {
            $dispute_service = New DisputeService($client, $auth_token);
            $dispute_payload = [
                "customer_email" => "tosyngy@rocketmail.com",
                "resolution" => "decline",
                "resolution_image" => null,
                "merchant_id" => "00000063",
                "amount" => "102.51",
                "evidence" =>  (array)[
                    (object)[
                    "message" => "Buyer didnt receive value",
                    "msg_sender" => "merchant",
                    "images" => [ (object)["image" => ""]]
                        ]
                ]
            ];
            $all_disputes = $dispute_service->update("00000063","bf3e2fee9bda491199b15a661cf31713", $dispute_payload);

            $this->assertArrayHasKey("dispute_ref", $all_disputes->toArray());

            $this->assertNotNull($all_disputes->toArray());
            $this->assertEquals("00", $all_disputes->toArray()['responseCode']);
        }catch (SeerbitException $e){

        }
    }
}