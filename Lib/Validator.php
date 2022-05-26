<?php

namespace Library;

abstract class Validator
{
    protected $errorMessage;

    public function __construct($errorMessage)
    {
        $this->setErrorMessage($errorMessage);
    }

    public function setErrorMessage($errorMessage): void
    {
        if (is_string($errorMessage)) {
            $this->errorMessage = $errorMessage;
        }
    }

    public function errorMessage()
    {
        return $this->errorMessage;
    }
}