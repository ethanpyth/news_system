<?php

namespace Library;

abstract class Field
{
    protected $errorMessage;
    protected $label;
    protected $name;
    protected $value;
    protected $validators = array();

    public function __construct(array $options = array())
    {
        if (!empty($options)) {
            $this->hydrate($options);
        }
    }

    abstract public function buildWidget();

    public function hydrate($options): void
    {
        foreach ($options as $type => $value) {
            $method = 'set' . ucfirst($type);

            if (is_callable(array($this, $method))) {
                $this->$method($value);
            }
        }
    }

    public function isValid(): bool
    {
        foreach ($this->validators as $validator) {
            if (!$validator->isValid($this->value)) {
                $this->errorMessage = $validator->errorMessage();
                return false;
            }
        }
        return true;
    }

    public function label()
    {
        return $this->label;
    }

    public function name()
    {
        return $this->name;
    }

    public function value()
    {
        return $this->value;
    }

    public function setLabel($label): void
    {
        if (is_string($label)) {
            $this->label = $label;
        }
    }

    public function setName($name): void
    {
        if (is_string($name)) {
            $this->name = $name;
        }
    }

    public function setValue($value): void
    {
        if (is_string($value)) {
            $this->value = $value;
        }
    }

    public function setValidators(array $validators)
    {
        foreach ($validators as $validator) {
            if ($validator instanceof Validator && !in_array($validator, $this->validators)) {
                $this->validators[] = $validator;
            }
        }
    }
}
