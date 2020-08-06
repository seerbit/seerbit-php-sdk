<?php


namespace Seerbit\Service\Validators;


class StandardValidator
{

    public static function Initialize(array $payload){
        if (!array_key_exists("amount",$payload)) {
            throw new \InvalidArgumentException('amount should not be empty');
        }
        if (!array_key_exists("currency",$payload)) {
            throw new \InvalidArgumentException('currency should not be empty');
        }
        if (!array_key_exists("country",$payload)) {
            throw new \InvalidArgumentException('country should not be empty');
        }
        if (!array_key_exists("email",$payload)) {
            throw new \InvalidArgumentException('email should not be empty');
        }
        if (!array_key_exists("paymentReference",$payload)) {
            throw new \InvalidArgumentException('paymentReference should not be empty');
        }
    }

}