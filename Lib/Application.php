<?php

namespace Library;

use Lib\HTTPRequest;
use Lib\HTTPResponse;

abstract class Application
{
    protected \Lib\HTTPRequest $httpRequest;
    protected \Lib\HTTPResponse $httResponse;
    protected string $name;
    protected User $user;
    protected Config $config;

    public function __construct()
    {
        $this->httpRequest = new HTTPRequest($this);
        $this->httResponse = new HTTPResponse($this);
        $this->user = new User($this);
        $this->config = new Config($this);
        $this->name = '';
    }

    public function getController()
    {
        $router = new \Lib\Router;

        $xml = new \DOMDocument;
        $xml->load(__DIR__ . '/../app/' . $this->name . '/Config/routes.xml');

        $routes = $xml->getElementsByTagName('route');

        foreach ($routes as $route)
        {
            $vars = array();

            if($route->hasAttribute('vars')) {
                $vars = explode(',', $route->getAttribute('vars'));
            }

            $router->addRoute(new Route($route->getAttribute('url'), $route->getAttribute('module'), $route->getAttribute('action'), $vars));
        }

        try
        {
            $matchedRoute = $router->getRoute($this->httpRequest->requestURI());
        }
        catch (\RuntimeException $e)
        {
            if ($e->getCode() == \Lib\Router::NO_ROUTE) {
                $this->httpResponse->redirect404();
            }
        }

        $_GET = array($_GET, $matchedRoute->vars());
        $controllersCLass = 'Applications\\' . $this->name . '\\Modules\\' . $matchedRoute->module() . 'Controller';

        return new $controllersCLass($this, $matchedRoute->module(), $matchedRoute->action());
    }

    abstract public function run();

    public function httpRequest(): HTTPRequest
    {
        return $this->httpRequest;
    }

    public function httpResponse(): HTTPResponse
    {
        return $this->httResponse;
    }

    public function name(): string
    {
        return $this->name;
    }
}