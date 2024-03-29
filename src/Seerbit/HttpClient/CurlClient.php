<?php

namespace Seerbit\HttpClient;

use Seerbit\SeerbitException;
use Seerbit\Service\IService;


class CurlClient implements IClient
{

    protected bool $shouldLog = false;
    /**
     * @throws SeerbitException
     */
    public function POST(IService $service, $requestUrl, $params = null, $token = null, $authType = \Seerbit\AuthType::BEARER)
    {

        $client = $service->getClient();
        $config = $client->getConfig();
        $logger = $client->getLogger();
        $jsonRequest = json_encode($params);

        // log the request
        $this->shouldLog && $this->logRequest($logger, $requestUrl, $params);

        //Initiate cURL.
        $ch = curl_init($requestUrl);

        //Tell cURL that we want to send a POST request.
        curl_setopt($ch, CURLOPT_POST, 1);

        //Attach our encoded JSON string to the POST fields.
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonRequest);

        //Set the content type to application/json
        $headers = array(
            'Content-Type: application/json'
        );

        //Set the timeout
        if ($config->getTimeout() != null) {
            curl_setopt($ch, CURLOPT_TIMEOUT, $config->getTimeout());
        }


        // set authorisation credentials according to support & availability
        if ($service->requiresToken()) {
            if(strlen($token) < 1){
                $msg = "Please provide an Authentication token";
                throw new SeerbitException($msg);
            }else{
                if($authType === \Seerbit\AuthType::BASIC){
                    $key = base64_encode($client->getPublicKey().":".$client->getSecretKey());
                    $headers[] = 'Authorization: Basic ' . $key;
                }else{
                    $headers[] = 'Authorization: Bearer ' . $token;
                }

                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            }

        } else {

            //Set the headers
            if($authType === \Seerbit\AuthType::BASIC){
                $key = base64_encode($client->getPublicKey().":".$client->getSecretKey());
                $headers[] = 'Authorization: Basic ' . $key;
            }else{
                $headers[] = 'Authorization: Bearer ' . $token;
            }

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        $this->shouldLog && $logger->info("Request headers to SeerBit" . print_r($headers, 1));

        // return the result
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        //Execute the request
        list($result, $httpStatus) = $this->curlRequest($ch);


        // log the raw response
        $this->shouldLog && $logger->info("JSON Response is: " . $result);

        // Get errors
        list($errno, $message) = $this->curlError($ch);

        curl_close($ch);
        // result not 200 or 201 ... throw error
        if (!in_array($httpStatus, [200,201]) && !$result) {
            $this->handleResultError($result, $logger);
        }
        elseif (!$result) {
            $this->handleCurlError($requestUrl,json_decode($result, true), $errno, $message, $logger);
        }

        // log the array result
        $this->shouldLog && $logger->info('Params in response from SeerBit: ' . print_r(json_decode($result, true), 1));

        $result = json_decode($result, true);

        if (is_array($result) || is_object($result)){
            $msg = "";
            $data = $result["data"] ?? null;
            if (is_null($data)){
                $data = $result["networks"] ?? null;
            }
            if(isset($result["message"]) ){
                $msg =  $result["message"];
            }elseif ($data){
                if (isset($result["data"]["message"])){
                    $msg =  $result["data"]["message"];
                }
            }
            return [
                "httpStatus" => $httpStatus,
                "data" => $data,
                "message" => $msg
            ];
        }elseif(is_string($result)){
            return ["httpStatus" => $httpStatus, "data" => null, "message" => (string)$result];
        }else{
            return ["httpStatus" => $httpStatus, "data" => null, "message" => "Unable to process response now try again."];
        }

    }

    /**
     * @throws SeerbitException
     */
    public function GET(IService $service, $requestUrl, $token = null, $authType = \Seerbit\AuthType::BEARER)
    {

        $client = $service->getClient();
        $config = $client->getConfig();
        $logger = $client->getLogger();

        // log the request
        $this->shouldLog && $this->logRequest($logger, $requestUrl, null);

        //Initiate cURL.
        $ch = curl_init($requestUrl);

        //Tell cURL that we want to send a GET request.
        curl_setopt($ch, CURLOPT_HTTPGET, true);

        //Set the content type to application/json
        $headers = [];

        //Set the timeout
        if ($config->getTimeout() != null) {
            curl_setopt($ch, CURLOPT_TIMEOUT, $config->getTimeout());
        }

        // set authorisation credentials according to support & availability
        if ($service->requiresToken()) {
            if(strlen($token) < 1){
                $msg = "Please provide an Authentication token";
                throw new SeerbitException($msg);
            }else{
                if($authType === \Seerbit\AuthType::BASIC){
                    $key = base64_encode($client->getPublicKey().":".$client->getSecretKey());
                    $headers[] = 'Authorization: Basic ' . $key;
                }else{
                    $headers[] = 'Authorization: Bearer ' . $token;
                }

                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            }

        } else {

            //Set the headers
            if($authType === \Seerbit\AuthType::BASIC){
                $key = base64_encode($client->getPublicKey().":".$client->getSecretKey());
                $headers[] = 'Authorization: Basic ' . $key;
            }else{
                $headers[] = 'Authorization: Bearer ' . $token;
            }

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }


        $this->shouldLog && $logger->info("Request headers to Seerbit" . print_r($headers, 1));

        // return the result
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        //Execute the request
        list($result, $httpStatus) = $this->curlRequest($ch);


        // log the raw response
        $this->shouldLog && $logger->info("JSON Response is: " . $result);

        // Get errors
        list($errno, $message) = $this->curlError($ch);

        curl_close($ch);

        if (!in_array($httpStatus, [200,201]) && $result) {
            $this->handleResultError($result, $logger);
        } elseif (!$result) {
            $this->handleCurlError($requestUrl,json_decode($result, true), $errno, $message, $logger);
        }

        // log the array result
        $this->shouldLog && $logger->info('Params in response from Seerbit:' . print_r($result, 1));

        $result = json_decode($result, true);

        if (is_array($result) || is_object($result)){
            $msg = "";
            $data = isset($result["data"]) ? $result["data"] : null;
            if (is_null($data)){
                $data = isset($result["networks"]) ? $result["networks"] : null;
            }
            if(isset($result["message"]) ){
                $msg =  $result["message"];
            }elseif ($data){
                if (isset($result["data"]["message"])){
                    $msg =  $result["data"]["message"];
                }
            }
            return [
                "httpStatus" => $httpStatus,
                "data" => $data,
                "message" => $msg
            ];
        }elseif(is_string($result)){
            return ["httpStatus" => $httpStatus, "data" => null, "message" => (string)$result];
        }else{
            return ["httpStatus" => $httpStatus, "data" => null, "message" => "Unable to process response now try again."];
        }

    }

    /**
     * @throws SeerbitException
     */
    public function PUT(IService $service, $requestUrl, $params = null, $token = null, $authType = \Seerbit\AuthType::BEARER)
    {

        $client = $service->getClient();
        $config = $client->getConfig();
        $logger = $client->getLogger();
        $jsonRequest = json_encode($params);

        // log the request
        $this->shouldLog && $this->logRequest($logger, $requestUrl, $params);

        //Initiate cURL.
        $ch = curl_init($requestUrl);

        //Tell cURL that we want to send a PUT request.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

        //Attach our encoded JSON string to the POST fields.
        curl_setopt($ch, CURLOPT_POSTFIELDS,$jsonRequest);

        //Set the content type to application/json
        $headers = array(
            'Content-Type: application/json'
        );

        //Set the timeout
        if ($config->getTimeout() != null) {
            curl_setopt($ch, CURLOPT_TIMEOUT, $config->getTimeout());
        }


        // set authorisation credentials according to support & availability
        if ($service->requiresToken()) {
            if(strlen($token) < 1){
                $msg = "Please provide an Authentication token";
                throw new SeerbitException($msg);
            }else{
                if($authType === \Seerbit\AuthType::BASIC){
                    $key = base64_encode($client->getPublicKey().":".$client->getSecretKey());
                    $headers[] = 'Authorization: Basic ' . $key;
                }else{
                    $headers[] = 'Authorization: Bearer ' . $token;
                }

                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            }

        } else {

            //Set the headers
            if($authType === \Seerbit\AuthType::BASIC){
                $key = base64_encode($client->getPublicKey().":".$client->getSecretKey());
                $headers[] = 'Authorization: Basic ' . $key;
            }else{
                $headers[] = 'Authorization: Bearer ' . $token;
            }

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        $this->shouldLog && $logger->info("Request headers to Seerbit" . print_r($headers, 1));



        // return the result
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        //Execute the request
        list($result, $httpStatus) = $this->curlRequest($ch);


        // log the raw response
        $this->shouldLog && $logger->info("JSON Response is: " . $result);

        // Get errors
        list($errno, $message) = $this->curlError($ch);

        curl_close($ch);

        // result not 200 ... throw error
        if (!in_array($httpStatus, [200,201]) && $result) {
            $this->handleResultError($result, $logger);
        } elseif (!$result) {
            $this->handleCurlError($requestUrl,json_decode($result, true), $errno, $message, $logger);
        }

        if (is_array($result) || is_object($result)){
            $msg = "";
            $data = isset($result["data"]) ? $result["data"] : null;
            if (is_null($data)){
                $data = isset($result["networks"]) ? $result["networks"] : null;
            }
            if(isset($result["message"]) ){
                $msg =  $result["message"];
            }elseif ($data){
                if (isset($result["data"]["message"])){
                    $msg =  $result["data"]["message"];
                }
            }
            return [
                "httpStatus" => $httpStatus,
                "data" => $data,
                "message" => $msg
            ];
        }elseif(is_string($result)){
            return ["httpStatus" => $httpStatus, "data" => null, "message" => (string)$result];
        }else{
            return ["httpStatus" => $httpStatus, "data" => null, "message" => "Unable to process response now try again."];
        }

    }

    /**
     * @throws SeerbitException
     */
    protected function handleCurlError($url, $result, $errno, $message, $logger)
    {
        $msg = match ($errno) {
            CURLE_OK => "Probably your Web Service username and/or password is incorrect",
            CURLE_COULDNT_RESOLVE_HOST, CURLE_OPERATION_TIMEOUTED => "Could not connect to Seerbit ($url).  Please check your "
                . "internet connection and try again.",
            CURLE_SSL_CACERT, CURLE_SSL_PEER_CERTIFICATE => "Could not verify Seerbit's SSL certificate.  Please make sure "
                . "that your network is not intercepting certificates.  "
                . "(Try going to $url in your browser.)  "
                . "If this problem persists,",
            default => "Unexpected error communicating with Seerbit Server.",
        };
        $msg .= "\n(Network error [errno $errno]: $message)";
        $msg .= "\n(Network error [result $errno]: $result)";
        $this->shouldLog && $logger->error($msg);
        throw new \Seerbit\SeerbitException($msg, $errno);
    }

    /**
     * @throws SeerbitException
     */
    protected function handleResultError($result, $logger)
    {

        $decodeResult = json_decode($result, true);

        if ($result) {
            if (isset($decodeResult['message'])) {
                $this->shouldLog && $logger->error($decodeResult['message']);
                throw new SeerbitException(
                    $decodeResult['message'],
                    "-00",
                    null,
                    400,
                    time()
                );
            }
            $this->shouldLog && $logger->error($result);
            throw new SeerbitException("Error making HTTP request to SeerBit server", 500, null, "Server Error", time());
        }else{
            $this->shouldLog && $logger->error($result);
            throw new SeerbitException("Error making HTTP request to SeerBit server", 500, null, "Server Error", time());
        }
    }

    private function logRequest(\Psr\Log\LoggerInterface $logger, $requestUrl, $params)
    {
        // log the requestUr, params and json request
        $this->shouldLog && $logger->info("Request url to SeerBit: " . $requestUrl);
        $this->shouldLog && $logger->info('JSON Request payload to SeerBit:' . json_encode($params));
    }

    protected function curlRequest($ch)
    {
        $result = curl_exec($ch);
        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        return array($result, $httpStatus);
    }

    protected function curlError($ch)
    {
        $errno = curl_errno($ch);
        $message = curl_error($ch);
        return array($errno, $message);
    }
}