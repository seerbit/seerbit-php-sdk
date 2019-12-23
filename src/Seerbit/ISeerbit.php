<?php


namespace Seerbit;


interface ISeerbit
{
    public static function getApiVersion();

    public static function getMaxNetworkRetries();

    public static function getMaxNetworkRetryDelay();

    public static function getMaxRetryAfter();

    public static function getInitialNetworkRetryDelay();

    public static function setMaxNetworkRetries($maxNetworkRetries);

    public static function setApiVersion($apiVersion);
}