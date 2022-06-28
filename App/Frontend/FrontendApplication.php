<?php

namespace Applications\Frontend;

use JetBrains\PhpStorm\NoReturn;

class FrontendApplication extends \Library\Application
{
    public function __construct()
    {
        parent::__construct();

        $this->name = 'Frontend';
    }

    #[NoReturn] public function run()
    {
        // TODO: Implement run() method.
        $controller = $this->getController();
        $controller->execute();

        $this->httpResponse->setPage($controller->page());
        $this->httpResponse->send();
    }
}
