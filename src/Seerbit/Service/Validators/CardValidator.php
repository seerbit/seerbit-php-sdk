<?php


namespace Seerbit\Service\Validators;


class CardValidator
{

    public static function Authorize(array $payload){
        if (!array_key_exists("amount",$payload)) {
            throw new \InvalidArgumentException('amount should not be empty');
        }
        if (!array_key_exists("cardNumber",$payload)) {
            throw new \InvalidArgumentException('cardNumber should not be empty');
        }
        if (!array_key_exists("cvv",$payload)) {
            throw new \InvalidArgumentException('cvv should not be empty');
        }
        if (!array_key_exists("expiryMonth",$payload)) {
            throw new \InvalidArgumentException('expiryMonth should not be empty');
        }
        if (!array_key_exists("expiryYear",$payload)) {
            throw new \InvalidArgumentException('expiryYear should not be empty');
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