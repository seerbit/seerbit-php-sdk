<?php


namespace Seerbit\Service\Validators;


class CardValidator
{

    public static function AuthorizeOnetime(array $payload){
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
        if (!array_key_exists("paymentReference",$payload)) {
            throw new \InvalidArgumentException('paymentReference should not be empty');
        }
    }

    public static function AuthorizeWithToken(array $payload){
        if (!array_key_exists("amount",$payload)) {
            throw new \InvalidArgumentException('amount should not be empty');
        }
        if (!array_key_exists("cardToken",$payload)) {
            throw new \InvalidArgumentException('cardToken should not be empty');
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

    public static function ChargeNon3DSWithToken(array $payload){
        if (!array_key_exists("amount",$payload)) {
            throw new \InvalidArgumentException('amount should not be empty');
        }
        if (!array_key_exists("cardToken",$payload)) {
            throw new \InvalidArgumentException('cardToken should not be empty');
        }
        if (!array_key_exists("currency",$payload)) {
            throw new \InvalidArgumentException('currency should not be empty');
        }if (!array_key_exists("country",$payload)) {
            throw new \InvalidArgumentException('country should not be empty');
        }
        if (!array_key_exists("email",$payload)) {
            throw new \InvalidArgumentException('email should not be empty');
        }
        if (!array_key_exists("paymentReference",$payload)) {
            throw new \InvalidArgumentException('paymentReference should not be empty');
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


    public static function Cancel(array $payload){
//        if (!array_key_exists("currency",$payload)) {
//            throw new \InvalidArgumentException('currency should not be empty');
//        }
        if (!array_key_exists("paymentReference",$payload)) {
            throw new \InvalidArgumentException('paymentReference should not be empty');
        }
        if (!array_key_exists("country",$payload)) {
            throw new \InvalidArgumentException('country should not be empty');
        }
//        if (!array_key_exists("amount",$payload)) {
//            throw new \InvalidArgumentException('amount should not be empty');
//        }
    }

    public static function Refund(array $payload){
        if (!array_key_exists("currency",$payload)) {
            throw new \InvalidArgumentException('currency should not be empty');
        }
        if (!array_key_exists("paymentReference",$payload)) {
            throw new \InvalidArgumentException('paymentReference should not be empty');
        }
        if (!array_key_exists("country",$payload)) {
            throw new \InvalidArgumentException('country should not be empty');
        }
        if (!array_key_exists("amount",$payload)) {
            throw new \InvalidArgumentException('amount should not be empty');
        }
    }

    public static function Capture(array $payload){
        if (!array_key_exists("currency",$payload)) {
            throw new \InvalidArgumentException('currency should not be empty');
        }
        if (!array_key_exists("paymentReference",$payload)) {
            throw new \InvalidArgumentException('paymentReference should not be empty');
        }
        if (!array_key_exists("country",$payload)) {
            throw new \InvalidArgumentException('country should not be empty');
        }
        if (!array_key_exists("amount",$payload)) {
            throw new \InvalidArgumentException('amount should not be empty');
        }
    }

    public static function ChargeNon3DOneTime(array $payload){
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
        if (!array_key_exists("paymentReference",$payload)) {
            throw new \InvalidArgumentException('paymentReference should not be empty');
        }
    }

    public static function Tokenize(array $payload){
        if (!array_key_exists("cardNumber",$payload)) {
            throw new \InvalidArgumentException('cardNumber should not be empty');
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
    }

    public static function ChargeWithoutPin(array $payload){
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
        if (!array_key_exists("channelType",$payload)) {
            throw new \InvalidArgumentException('channelType should not be empty');
        }
        if (!array_key_exists("paymentReference",$payload)) {
            throw new \InvalidArgumentException('paymentReference should not be empty');
        }
    }

    public static function ChargeWithPin(array $payload){
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
        if (!array_key_exists("paymentReference",$payload)) {
            throw new \InvalidArgumentException('paymentReference should not be empty');
        }
    }
}