<?php

namespace Library;

class HTTPRequest extends ApplicationComponent
{
    public function cookieData($key): ?bool
    {
        return $_COOKIE[$key] ?? null;
    }

    public function cookieExists($key): bool
    {
        return isset($_COOKIE[$key]);
    }

    public function getData($key): ?bool
    {
        return $_GET[$key] ?? null;
    }

    public function getExists($key): bool
    {
        return isset($_GET[$key]);
    }

    public function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function postData($key): bool
    {
        return isset($_POST[$key]);
    }

    public function postExists($key): bool
    {
        return isset($_POST[$key]);
    }

    public function requestURI()
    {
        return $_SERVER['REQUEST_URI'];
    }
}