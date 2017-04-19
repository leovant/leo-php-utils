<?php

namespace LeoUtils;
/**
 * Exception class.
 */
class Exception extends \Exception
{
    /**
     * Exception details.
     *
     * @var array
     */
    protected $details = [];
    /**
     * Set exception details.
     *
     * @param array $details
     * @return \LeoUtils\Exception
     */
    public function withDetails(array $details)
    {
        $this->details = $details;
        return $this;
    }
    /**
     * Get exception details.
     *
     * @return array
     */
    public function getDetails()
    {
        return $this->details;
    }
    /**
     * Throws the exception.
     *
     * @return void
     */
    public function throw()
    {
        throw $this;
    }
}