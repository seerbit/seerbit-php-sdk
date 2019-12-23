<?php

namespace Seerbit;

Interface IConfig
{

    public function getPublicKey();

    public function getPrivateKey();

    public function get($param);

    public function set($key, $value);

    public function getInputType();

    public function getOutputType();

    public function getTimeout();

    public function getHash();

    public function getClientSecret();

    public function getPassword();

    public function getUserName();
}