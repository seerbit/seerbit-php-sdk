<?php

namespace Seerbit\Service\Card;

use Seerbit\Client;

interface TokenizeServiceContract {

    public function CreateToken(array $payload);

    public function GetToken(string $reference);

    public function ValidateOtp(array $payload);

    public function ChargeToken(array $payload);

    public function ChargeTokenBulk(array $payload);
}