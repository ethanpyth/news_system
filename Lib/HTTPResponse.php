<?php

namespace Library;

class HTTPResponse extends ApplicationComponent
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

    public function redirect404()
    {
        $this->page = new Page($this->app);
        $this->page->setContentFile(__DIR__ . '/../Errors/404.html');
        $this->addHeader('HTTP/1.0 404 Not Found');
        $this->send();
    }
}