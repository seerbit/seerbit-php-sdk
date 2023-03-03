<?php
namespace Seerbit;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;


class Client{

    const VERSION = '0.0.1';
    const ENDPOINT_PILOT = "https://pilot-backend.seerbitapi.com/";
    const ENDPOINT_LIVE = "https://seerbitapi.com/api/v2/";

    private $config;

    private $logger;
    private $logger_path = "";

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

    public function setAuthType($type)
    {
        $this->config->set('authType', $type);
    }

    public function setSecretKey($secretKey)
    {
        $this->config->set('secretKey', $secretKey);
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

    public function getAuthType()
    {
        return $this->config->get('authType');
    }

    public function getSecretKey()
    {
        return $this->config->get('secretKey');
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
        $this->logger_path = $path;
    }

    public function setLogger($logger)
    {
        $this->logger = $logger;
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
            $logger->pushHandler(new StreamHandler(($this->logger_path ? $this->logger_path : dirname(__FILE__) ) . '/seerbit.log', Logger::DEBUG));
        } catch (\Exception $e) {
        }
        return $logger;
    }


}