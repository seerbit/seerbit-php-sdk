<?php

namespace Seerbit;

class Config implements IConfig
{
    /**
     * @var array
     */
    protected $data = array('environment' => 'live', 'endpoint' => 'https://seerbitapi.com/api/v2/');

    /**
     * @var array
     */
    protected $allowedInput = array('array', 'json');

    /**
     * @var string
     */
    protected $defaultInput = 'array';

    /**
     * @var array
     */
    protected $allowedOutput = array('array', 'json');

    /**
     * @var string
     */
    protected $defaultOutput = 'array';

    /**
     * Config constructor.
     *
     * @param null $params
     */
    public function __construct($params = null)
    {
        if ($params && is_array($params)) {
            foreach ($params as $key => $param) {
                $this->data[$key] = $param;
            }
        }
    }

    /**
     * Get a specific key value.
     *
     * @param string $key Key to retrieve.
     *
     * @return mixed|null Value of the key or NULL
     */
    public function get($key)
    {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }

    /**
     * Set a key value pair
     *
     * @param string $key Key to set
     * @param mixed $value Value to set
     */
    public function set($key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * @return mixed|string
     */
    public function getInputType()
    {
        if (isset($this->data['inputType']) && in_array($this->data['inputType'], $this->allowedInput)) {
            return $this->data['inputType'];
        }

        return $this->defaultInput;
    }

    /**
     * @return mixed|string
     */
    public function getPublicKey()
    {
        if (isset($this->data['publicKey'])) {
            return $this->data['publicKey'];
        }

        return null;
    }

    public function getPrivateKey()
    {
        if (isset($this->data['privateKey'])) {
            return $this->data['privateKey'];
        }

        return null;
    }

    public function getUserName()
    {
        if (isset($this->data['userName'])) {
            return $this->data['userName'];
        }

        return null;
    }

    public function getPassword()
    {
        if (isset($this->data['password'])) {
            return $this->data['password'];
        }

        return null;
    }

    /**
     * @return mixed|string
     */
    public function getOutputType()
    {
        if (isset($this->data['outputType']) && in_array($this->data['outputType'], $this->allowedOutput)) {
            return $this->data['outputType'];
        }

        return $this->defaultOutput;
    }

    public function getClientSecret()
    {
        try{
            $hash = hash('sha256', $this->getPublicKey() ."." .$this->getPrivateKey());
            return $hash;
        }catch (\Exception $e){
            return null;
        }
    }

    /**
     * @return mixed|null
     */
    public function getTimeout()
    {
        return !empty($this->data['timeout']) ? $this->data['timeout'] : null;
    }

    public function getHash(){

    }



}