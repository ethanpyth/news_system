<?php

namespace Library;

abstract class ApplicationComponent
{
    protected Application $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function app(): Application
    {
        return $this->app;
    }
}