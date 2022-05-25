<?php

namespace Library;

class User extends ApplicationComponent
{
    public function getAttribute($attr)
    {
        return $_SESSION[$attr] ?? null;
    }

    public function getFlash()
    {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);

        return $flash;
    }

    public function hasFlash(): bool
    {
        return isset($_SESSION['flash']);
    }

    public function isAuthenticated(): bool
    {
        return isset($_SESSION['auth']) && $_SESSION['auth'] === true;
    }

    public function setAttribute($attr, $value)
    {
        $_SESSION[$attr] = $value;
    }

    public function setAuthenticated($authenticated = true)
    {
        if (!is_bool($authenticated)) {
            throw new \InvalidArgumentException(
                'La valeur spécifié à la méthode User::setAuthenticated() doit etre un booléen'
            );
        }

        $_SESSION['auth'] = $authenticated;
    }

    public function setFlash($value)
    {
        $_SESSION['flash'] = $value;
    }
}