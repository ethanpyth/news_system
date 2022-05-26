<?php

namespace Library;

class StringField extends Field
{
    protected $maxLength;

    public function buildWidget(): string
    {
        // TODO: Implement buildWidget() method.
        $widget = '';

        if (!empty($this->errorMessage)) {
            $widget .= $this->errorMessage . '<br>';
        }

        $widget .= '<label>' . $this->label . '</label><input type="text" name="' . $this->name . '"';
        if (!empty($this->value)) {
            $widget .= ' value="' . htmlspecialchars($this->value) . '"';
        }

        if (!empty($this->maxLength)) {
            $widget .= ' maxlength"' . $this->maxLength . '"';
        }

        return $widget .= '>';
    }

    public function setMaxLength($maxlength)
    {
        if ($maxlength > 0) {
            $this->maxLength = $maxlength;
        } else{
            throw new \RuntimeException('La longueur maximale doit etre un nombre supérieur à 0');
        }
    }
}