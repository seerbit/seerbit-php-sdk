<?php

namespace Seerbit\HttpClient;

interface IClient
{

    public function POST(\SeerBit\Service\IService $service, $requestUrl, $params, $token,$authType);

    public function PUT(\SeerBit\Service\IService $service, $requestUrl, $params, $token,$authType);

    public function GET(\Seerbit\Service\IService $service, $requestUrl, $token,$authType);

}