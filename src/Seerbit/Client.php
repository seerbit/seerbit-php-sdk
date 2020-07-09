<?php
namespace Seerbit;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;


class Client{

    const VERSION = '0.0.1';
    const ENDPOINT_PILOT = "https://pilot-backend.seerbitapi.com/";
    const ENDPOINT_LIVE = "https://stg-backend.seerbitapi.com/api/v2/";

    private $config;

    private $logger;

    public function __construct()
    {
        $this->config = new Config();
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config;
    }

    public function setPublicKey($publicKey)
    {
        $this->config->set('publicKey', $publicKey);
    }

    public function setToken($token)
    {
        $this->config->set('token', $token);
    }

    public function setPrivateKey($publicKey)
    {
        $this->config->set('privateKey', $publicKey);
    }

    public function setUsername($username)
    {
        $this->config->set('userName', $username);
    }

    public function setPassword($password)
    {
        $this->config->set('password', $password);
    }

    public function getUsername()
    {
        return $this->config->get('userName');
    }

    public function getPassword()
    {
        return $this->config->get('password');
    }

    public function getPublicKey()
    {
        return $this->config->get('publicKey');
    }

    public function getToken()
    {
        return $this->config->get('token');
    }

    public function getPrivateKey()
    {
        return $this->config->get('privateKey');
    }

    public function setConfig($config)
    {
        $this->config = $config;
    }


    public function setEnvironment($environment)
    {
        if ($environment == \Seerbit\Environment::PILOT) {
            $this->config->set('environment', \Seerbit\Environment::PILOT);
            $this->config->set('endpoint', self::ENDPOINT_PILOT);

        } elseif ($environment == \Seerbit\Environment::LIVE) {
            $this->config->set('environment', \Seerbit\Environment::LIVE);
            $this->config->set('endpoint', self::ENDPOINT_LIVE);
        } else {
            // environment does not exist
            $msg = "This environment does not exist, use " . \Seerbit\Environment::PILOT . ' or ' . \Seerbit\Environment::LIVE;
            throw new \Seerbit\SeerbitException($msg);
        }
    }

    public function getEnvironment()
    {
        return $this->config->get('environment');
    }

    public function getVersion()
    {
        return $this->config->get('version');
    }


    public function setLoggerPath($path)
    {
//        $this->logger = $logger;
    }

    public function setInputType($value)
    {
        $this->config->set('inputType', $value);
    }

    public function setOutputType($value)
    {
        $this->config->set('outputType', $value);
    }

    public function setTimeout($value)
    {
        $this->config->set('timeout', $value);
    }


    public function getTimeout()
    {
        return $this->config->get('timeout');
    }


    public function getLogger()
    {
        if (!isset($this->logger)) {
            $this->logger = $this->createDefaultLogger();
        }
        return $this->logger;
    }

    protected function createDefaultLogger()
    {
            $logger = new Logger('seerbit-php-api-library');
        try {
            $logger->pushHandler(new StreamHandler(dirname(__FILE__) . '/app.log', Logger::DEBUG));
        } catch (\Exception $e) {
        }
        return $logger;
    }


}