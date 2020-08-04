<?php


namespace Seerbit\Service\Validators;


class RecurrentValidator
{

    public static function Create(array $payload){
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
        if (!array_key_exists("amount",$payload)) {
            throw new \InvalidArgumentException('amount should not be empty');
        }
        if (!array_key_exists("customerId",$payload)) {
            throw new \InvalidArgumentException('customerId should not be empty');
        }
        if (!array_key_exists("billingCycle",$payload)) {
            throw new \InvalidArgumentException('billingCycle should not be empty');
        }
        if (!array_key_exists("currency",$payload)) {
            throw new \InvalidArgumentException('currency should not be empty');
        }if (!array_key_exists("country",$payload)) {
            throw new \InvalidArgumentException('country should not be empty');
        }
        if (!array_key_exists("email",$payload)) {
            throw new \InvalidArgumentException('email should not be empty');
        }
        if (!array_key_exists("startDate",$payload)) {
            throw new \InvalidArgumentException('startDate should not be empty');
        }
        if (!array_key_exists("paymentReference",$payload)) {
            throw new \InvalidArgumentException('startDate should not be empty');
        }

    }

    public static function Get($customerId){
        if (!isset($customerId)) {
            throw new \InvalidArgumentException('customerId should not be empty');
        }
        if (!is_string($customerId)) {
            throw new \InvalidArgumentException('customerId should be a string');
        }
    }

    public static function Update($payload){
        if (!array_key_exists("amount",$payload)) {
            throw new \InvalidArgumentException('amount should not be empty');
        }
        if (!array_key_exists("currency",$payload)) {
            throw new \InvalidArgumentException('currency should not be empty');
        }
        if (!array_key_exists("mobileNumber",$payload)) {
            throw new \InvalidArgumentException('mobileNumber should not be empty');
        }
        if (!array_key_exists("status",$payload)) {
            throw new \InvalidArgumentException('status should not be empty');
        }
    }

    public static function Charge($payload){
        if (!array_key_exists("amount",$payload)) {
            throw new \InvalidArgumentException('amount should not be empty');
        }
        if (!array_key_exists("currency",$payload)) {
            throw new \InvalidArgumentException('currency should not be empty');
        }
        if (!array_key_exists("authorizationCode",$payload)) {
            throw new \InvalidArgumentException('authorizationCode should not be empty');
        }
        if (!array_key_exists("email",$payload)) {
            throw new \InvalidArgumentException('email should not be empty');
        }
        if (!array_key_exists("paymentReference",$payload)) {
            throw new \InvalidArgumentException('paymentReference should not be empty');
        }
    }

}