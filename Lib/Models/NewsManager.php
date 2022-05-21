<?php

namespace Library\Models;

abstract class NewsManager extends \Library\Manager
{
    abstract public function getList($debut = -1, $limite = -1);
    abstract public function getUnique($id);
}