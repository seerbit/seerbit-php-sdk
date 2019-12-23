<?php

namespace Seerbit\HttpClient;

interface IClient
{

    public function POST(\SeerBit\Service\IService $service, $requestUrl, $params, $token);

    public function PUT(\SeerBit\Service\IService $service, $requestUrl, $params, $token);

    public function GET(\Seerbit\Service\IService $service, $requestUrl, $token);

}