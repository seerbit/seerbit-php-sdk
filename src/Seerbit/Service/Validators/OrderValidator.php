<?php


namespace Seerbit\Service\Validators;


class OrderValidator
{

    public static function Create(array $payload){
        if (!array_key_exists("amount",$payload)) {
            throw new \InvalidArgumentException('amount should not be empty');
        }
        if (!array_key_exists("orderType",$payload)) {
            throw new \InvalidArgumentException('orderType should not be empty');
        }
        if (!array_key_exists("orders",$payload)) {
            throw new \InvalidArgumentException('orders should not be empty');
        }
        if (!is_array($payload["orders"])) {
            throw new \InvalidArgumentException('orders should be an array');
        }
        if (!array_key_exists("currency",$payload)) {
            throw new \InvalidArgumentException('currency should not be empty');
        }if (!array_key_exists("country",$payload)) {
            throw new \InvalidArgumentException('country should not be empty');
        }if (!array_key_exists("fullName",$payload)) {
            throw new \InvalidArgumentException('fullName should not be empty');
        }
        if (!array_key_exists("email",$payload)) {
            throw new \InvalidArgumentException('email should not be empty');
        }
        if (!array_key_exists("paymentReference",$payload)) {
            throw new \InvalidArgumentException('paymentReference should not be empty');
        }
    }


}