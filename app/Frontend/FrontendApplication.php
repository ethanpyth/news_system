<?php

namespace Applications\Frontend;

class FrontendApplication extends \Lib\Application
{

    public function run()
    {
        // TODO: Implement run() method.
        $controller = $this->getController();
        $controller->execute();

        $this->httResponse->setPage($controller->page());
        $this->httResponse->send();
    }
}