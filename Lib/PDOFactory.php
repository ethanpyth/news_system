<?php

namespace Library;

class PDOFactory
{
    public function getMysqlConnexion(): \PDO
    {
        $db = new \PDO('mysql:host=localhost;dbname=news', 'root', '');
        $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $db;
    }
}