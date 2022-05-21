<?php

namespace Library\Models;

use \Library\Entities\Comment;
abstract class CommentManager extends \Library\Manager
{
    abstract protected function add(Comment $comment);
    public function save(Comment $comment)
    {
        if ($comment->isValid()) {
            $comment->isNew() ? $this->add($comment) : $this->modify($comment);
        }
        else {
            throw new \RuntimeException('Le commentaire doit etre validé pour etre enregitré');
        }
    }
    abstract public function getListOf($news);
}