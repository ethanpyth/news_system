<?php

namespace Applications\Backend;

class BackendApplication extends \Library\Application
{
    public function __construct()
    {
        parent::__construct();

        $this->name = 'Backend';
    }

    public function run()
    {
        // TODO: Implement run() method.
        if ($this->user->isAuthenticated()) {
            $controller = $this->getController();
        }
        else {
            $controller = new Modules\Connexion\ConnexionController($this, 'Connexion', 'index');
        }

        $controller-execute();

        $this->httpResponse->setPage($controller->page());
        $this->httpResponse->send();
    }
}