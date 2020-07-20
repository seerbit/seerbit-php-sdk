<?php


namespace Seerbit\Service\Validators;


class AccountValidator
{

    public static function Authorize(array $payload){
        if (!array_key_exists("amount",$payload)) {
            throw new \InvalidArgumentException('amount should not be empty');
        }
        if (!array_key_exists("accountName",$payload)) {
            throw new \InvalidArgumentException('accountName should not be empty');
        }
        if (!array_key_exists("accountNumber",$payload)) {
            throw new \InvalidArgumentException('accountNumber should not be empty');
        }
        if (!array_key_exists("bankCode",$payload)) {
            throw new \InvalidArgumentException('bankCode should not be empty');
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
    }

    public static function Validate(array $payload){
        if (!array_key_exists("otp",$payload)) {
            throw new \InvalidArgumentException('otp should not be empty');
        }
        if (!array_key_exists("linkingReference",$payload)) {
            throw new \InvalidArgumentException('linkingReference should not be empty');
        }
    }
}