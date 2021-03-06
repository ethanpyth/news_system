<?php

namespace Library;

use DOMDocument;
use http\Exception\RuntimeException;

abstract class Application
{
    protected HTTPRequest $httpRequest;
    protected HTTPResponse $httpResponse;
    protected string $name;
    protected User $user;
    protected Config $config;

    public function __construct()
    {
        $this->httpRequest = new HTTPRequest($this);
        $this->httpResponse = new HTTPResponse($this);
        $this->user = new User($this);
        $this->config = new Config($this);
        $this->name = '';
    }

    public function getController()
    {
        $router = new Router;

        $xml = new DOMDocument;
        $xml->load(__DIR__ . '/../App/' . $this->name . '/Config/routes.xml');

        $routes = $xml->getElementsByTagName('route');

        foreach ($routes as $route)
        {
            $vars = array();

            if ($route->hasAttribute('vars')) {
                $vars = explode(',', $route->getAttribute('vars'));
            }

            $router->addRoute(new Route($route->getAttribute('url'), $route->getAttribute('module'), $route->getAttribute('action'), $vars));
        }

        try
        {
            $matchedRoute = $router->getRoute($this->httpRequest->requestURI());
        }
        catch (RuntimeException $e)
        {
            if ($e->getCode() == Router::NO_ROUTE) {
                $this->httpResponse->redirect404();
            }
        }

        $_GET = array_merge($_GET, $matchedRoute->vars());
        $controllersCLass = 'Applications\\' . $this->name . '\\Modules\\' . $matchedRoute->module(). '\\' . $matchedRoute->module() .  'Controller';

        return new $controllersCLass($this, $matchedRoute->module(), $matchedRoute->action());
    }

    abstract public function run();

    public function httpRequest(): HTTPRequest
    {
        return $this->httpRequest;
    }

    public function httpResponse(): HTTPResponse
    {
        return $this->httpResponse;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function config(): Config
    {
        return $this->config;
    }

    public function user(): User
    {
        return $this->user;
    }
}
