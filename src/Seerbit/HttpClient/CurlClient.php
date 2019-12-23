<?php

namespace Seerbit\HttpClient;

use Seerbit\SeerbitException;
use SeerBit\Service;
use Seerbit\Service\IService;


class CurlClient implements IClient
{


    public function POST(IService $service, $requestUrl, $params = null, $token = null)
    {

        $client = $service->getClient();
        $config = $client->getConfig();
        $logger = $client->getLogger();
        $jsonRequest = json_encode($params);

        // log the request
        $this->logRequest($logger, $requestUrl, $params);

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
            if(count($token) < 1){
                $msg = "Please provide an Authentication token";
                throw new SeerbitException($msg);
            }else{
                array_push($headers,'Authorization: Bearer '.$token);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            }

        } else {

            //Set the headers
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        $logger->info("Request headers to Seerbit" . print_r($headers, 1));



        // return the result
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        //Execute the request
        list($result, $httpStatus) = $this->curlRequest($ch);


        // log the raw response
        $logger->info("JSON Response is: " . $result);

        // Get errors
        list($errno, $message) = $this->curlError($ch);

        curl_close($ch);

        // result not 200 ... throw error
        if ($httpStatus != 200 && $result) {
            $this->handleResultError($result, $logger);
        } elseif (!$result) {
            $this->handleCurlError($requestUrl, $errno, $message, $logger);
        }

        // result in array or json
        if ($config->getOutputType() == 'array') {

            // transform to PHP Array
            $result = json_decode($result, true);

            // log the array result
            $logger->info('Params in response from Seerbit:' . print_r($result, 1));
        }

            return $result;

    }

    public function GET(IService $service, $requestUrl, $token = null)
    {

        $client = $service->getClient();
        $config = $client->getConfig();
        $logger = $client->getLogger();

        // log the request
        $this->logRequest($logger, $requestUrl, null);

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
            if(!$token){
                $msg = "Please provide an Authentication token";
                throw new SeerbitException($msg);
            }else{
                array_push($headers,'Authorization: Bearer '.$token);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            }

        } else {

            //Set the headers
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        $logger->info("Request headers to Seerbit" . print_r($headers, 1));

        // return the result
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        //Execute the request
        list($result, $httpStatus) = $this->curlRequest($ch);


        // log the raw response
        $logger->info("JSON Response is: " . $result);

        // Get errors
        list($errno, $message) = $this->curlError($ch);

        curl_close($ch);

        // result not 200 ... throw error
        if ($httpStatus != 200 && $result) {
            $this->handleResultError($result, $logger);
        } elseif (!$result) {
            $this->handleCurlError($requestUrl, $errno, $message, $logger);
        }

        // result in array or json
        if ($config->getOutputType() == 'array') {

            // transform to PHP Array
            $result = json_decode($result, true);

            // log the array result
            $logger->info('Params in response from Seerbit:' . print_r($result, 1));
        }

        return $result;

    }

    public function PUT(IService $service, $requestUrl, $params = null, $token = null)
    {

        $client = $service->getClient();
        $config = $client->getConfig();
        $logger = $client->getLogger();
        $jsonRequest = json_encode($params);

        // log the request
        $this->logRequest($logger, $requestUrl, $params);

        //Initiate cURL.
        $ch = curl_init($requestUrl);

        //Tell cURL that we want to send a POST request.
        curl_setopt($ch, CURLOPT_PUT, true);

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
            if(count($token) < 1){
                $msg = "Please provide an Authentication token";
                throw new SeerbitException($msg);
            }else{
                array_push($headers,'Authorization: Bearer '.$token);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            }

        } else {

            //Set the headers
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        $logger->info("Request headers to Seerbit" . print_r($headers, 1));



        // return the result
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        //Execute the request
        list($result, $httpStatus) = $this->curlRequest($ch);


        // log the raw response
        $logger->info("JSON Response is: " . $result);

        // Get errors
        list($errno, $message) = $this->curlError($ch);

        curl_close($ch);

        // result not 200 ... throw error
        if ($httpStatus != 200 && $result) {
            $this->handleResultError($result, $logger);
        } elseif (!$result) {
            $this->handleCurlError($requestUrl, $errno, $message, $logger);
        }

        // result in array or json
        if ($config->getOutputType() == 'array') {

            // transform to PHP Array
            $result = json_decode($result, true);

            // log the array result
            $logger->info('Params in response from Seerbit:' . print_r($result, 1));
        }

        return $result;

    }

    protected function handleCurlError($url, $errno, $message, $logger)
    {
        switch ($errno) {
            case CURLE_OK:
                $msg = "Probably your Web Service username and/or password is incorrect";
                break;
            case CURLE_COULDNT_RESOLVE_HOST:
            case CURLE_OPERATION_TIMEOUTED:
                $msg = "Could not connect to Seerbit ($url).  Please check your "
                    . "internet connection and try again.";
                break;
            case CURLE_SSL_CACERT:
            case CURLE_SSL_PEER_CERTIFICATE:
                $msg = "Could not verify Seerbit's SSL certificate.  Please make sure "
                    . "that your network is not intercepting certificates.  "
                    . "(Try going to $url in your browser.)  "
                    . "If this problem persists,";
                break;
            default:
                $msg = "Unexpected error communicating with Seerbit.";
        }
        $msg .= "\n(Network error [errno $errno]: $message)";
        $logger->error($msg);
        throw new \Seerbit\ConnectionException($msg, $errno);
    }

    protected function handleResultError($result, $logger)
    {
        $decodeResult = json_decode($result, true);
        if (isset($decodeResult['message']) && isset($decodeResult['errorCode'])) {
            $logger->error($decodeResult['errorCode'] . ': ' . $decodeResult['message']);
            throw new SeerbitException(
                $decodeResult['message'],
                $decodeResult['errorCode'],
                null,
                $decodeResult['status'],
                $decodeResult['errorType'],
                isset($decodeResult['pspReference']) ? $decodeResult['pspReference'] : null
            );
        }
        $logger->error($result);
        throw new SeerbitException($result);
    }

    private function logRequest(\Psr\Log\LoggerInterface $logger, $requestUrl, $params)
    {
        // log the requestUr, params and json request
        $logger->info("Request url to Seerbit: " . $requestUrl);
        if (isset($params["additionalData"]) && isset($params["additionalData"]["card.encrypted.json"])) {
            $params["additionalData"]["card.encrypted.json"] = "*";
        }
        if (isset($params["card"]) && isset($params["card"]["number"])) {
            $params["card"]["number"] = "*";
            $params["card"]["cvc"] = "*";
        }
        $logger->info('JSON Request payload to Seerbit:' . json_encode($params));
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