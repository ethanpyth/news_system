<?php

namespace Library;

class NotNullValidator extends Validator
{
    public function isValid($value): bool
    {
        return $value != '';
    }
}