<?php

namespace Library\Entities;

class Comment extends \Library\Entity
{
    protected $news, $auteur, $contenu, $date;

    const AUTEUR_INVALIDE = 1;
    const CONTENU_INVALIDE = 1;

    public function isValid()
    {
        return !(empty($this->auteur) || empty($this->contenu));
    }

    public function setAuteur($auteur)
    {
        if (!is_string($auteur) || empty($auteur)) {
            $this->erreurs[] = self::AUTEUR_INVALIDE;
        }
        else {
            $this->auteur = $auteur;
        }
    }

    public function setContenu($contenu)
    {
        if (!is_string($contenu) || empty($contenu)) {
            $this->erreurs[] = self::CONTENU_INVALIDE;
        }
        else {
            $this->contenu = $contenu;
        }
    }

    public function setDate(\Datetime $date)
    {
        $this->date = $date;
    }

    public function news()
    {
        return $this->news;
    }

    public function auteur()
    {
        return $this->auteur;
    }

    public function contenu()
    {
        return $this->id;
    }

    public function date()
    {
        return $this->date;
    }
}