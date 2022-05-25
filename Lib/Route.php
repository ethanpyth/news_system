<?php

namespace Library;

class Route
{
    protected $action;
    protected $module;
    protected $url;
    protected $varsNames;
    protected array $vars = array();

    public function __construct($url, $module, $action, array $varsNames)
    {
        $this->setUrl($url);
        $this->setModule($module);
        $this->setAction($action);
        $this->setVarsNames($varsNames);
    }

    public function hasVars(): bool
    {
        return !empty($this->varsNames);
    }

    public function match($url)
    {
        if (preg_match('^'. $this->url . '$', $url, $matches)) {
            return $matches;
        }
        else{
            return false;
        }
    }

    public function setAction($action): void
    {
        if (is_string($action)) {
            $this->action = $action;
        }
    }

    public function setModule($module): void
    {
        if (is_string($module)) {
            $this->module = $module;
        }
    }

    public function setVarsNames(array $varsNames): void
    {
        $this->varsNames = $varsNames;
    }

    public function setVars(array $vars): void
    {
        $this->vars = $vars;
    }

    public function action()
    {
        return $this->action;
    }

    public function module()
    {
        return $this->module;
    }

    public function vars(): array
    {
        return $this->vars;
    }

    public function varsNames()
    {
        return $this->varsNames;
    }

    public function setUrl($url): void
    {
        $this->url = $url;
    }
}