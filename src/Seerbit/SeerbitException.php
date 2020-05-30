<?php

namespace Seerbit;



class SeerbitException extends \Exception
{
    /**
     * @var null
     */
    protected $status;

    /**
     * @var null
     */
    protected $timestamp;

    protected $code;


    /**
     * SeerBitException constructor.
     *
     * @param string $message
     * @param int $code
     * @param Exception|null $previous
     * @param string|null $status
     * @param string|null $timestamp
     */
    public function __construct(
        $message = "",
        $code = 0,
        Exception $previous = null,
        $status = null,
        $timestamp = null
    ) {
        $this->status = $status;
        $this->timestamp = $timestamp;
        $this->code = $code;
        parent::__construct($message, (int)$code, $previous);
    }

    /**
     * Get status
     *
     * @return string|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    public function getTimestamp()
    {
        return $this->timestamp;
    }

    public function getErrorCode()
    {
        return $this->code;
    }




}