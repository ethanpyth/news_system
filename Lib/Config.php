<?php

namespace Library;

class Config extends ApplicationComponent
{
    protected array $vars = array();
    public function get(String $var): ?String
    {
        if (!$this->vars) {
            $xml = new \DOMDocument;
            $xml->load(__DIR__ . '/../Applications/' . $this->app->name() . '/Config/app.xml');
            $elements = $xml->getElementsByTagName('define');

            foreach ($elements as $element)
            {
                $this->vars[$element->getAttribute('var')] = $element->getAttribute('value');
            }
        }

        if (isset($this->vars[$var])) {
            return $this->vars[$var];
        }

        return null;
    }
}