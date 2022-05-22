<?php

namespace Library\Models;

use Library\Entities\News;

abstract class NewsManager extends \Library\Manager
{
    abstract public function getList($debut = -1, $limite = -1);
    abstract public function getUnique($id);
    abstract public function count();
    abstract public function add(News $news);
    public function save(News $news)
    {
        if ($news->isValid()) {
            $news->isNew() ? $this->add($news) : $this->modify($news);
        }
        else {
            throw new \RuntimeException('La news doit etre validée pour etre enregistrée');
        }
    }
}