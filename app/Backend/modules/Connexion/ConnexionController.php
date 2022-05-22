<?php

namespace Applications\Backend\modules\Connexion;

class ConnexionController extends \Library\BackController
{
    public function executeIndex(\Library\HTTPRequest $request)
    {
        $this->page->addVar('Title', 'Connexion');
        if ($request->postExists('login')) {
            $login = $request->postData('login');
            $password = $request->postData('password');

            if ($login == $this->app->config()->get('login') && $password == $this->app->config()->get('pass')) {
                $this->app->user()->setQuthenticqted(true);
                $this->app->httpResponse()->redirect('.');
            }
            else {
                $this->app->user()->setFlash('Le pseudo ou le mot de passe est incorrect.');
            }
        }
    }
}