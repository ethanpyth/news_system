<?php

namespace Library;

class HTTPResponse
{
    protected $page;

    public function addHeader($header)
    {
        header($header);
    }

    public function redirect($location)
    {
        header('Location: ' . $location);
        exit;
    }

    public function send()
    {
        exit($this->page->getGeneratedPage());
    }

    public function setPage($page)
    {
        $this->page = $page;
    }

    public function setCookie($name, $value = '', $expires = 0, $path = null, $domain = null, $secure = false, $httpOnly = true)
    {
        setCookie($name, $value, $expires, $path, $domain, $secure, $httpOnly);
    }


}