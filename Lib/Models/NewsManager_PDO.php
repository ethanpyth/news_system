<?php

namespace Library\Models;

class NewsManager_PDO extends NewsManager
{
    /**
     * @throws \Exception
     */
    public function getList($debut = -1, $limite = -1)
    {
        // TODO: Implement getList() method.
        $sql = 'SELECT id, auteur, titre, contenu, dateAjout, dateModif FROM news ORDER BY id DESC';
        if ($debut != -1 || $limite != -1) {
            $sql .= ' LIMIT ' . (int) $limite . ' OFFSET ' . (int) $debut;
        }

        $requete = $this->dao->query($sql);
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Library\Entities\News');
        $listeNews = $requete->fetchAll();

        foreach ($listeNews as $news)
        {
            $news->setDateAjout(new \DateTime($news->dateAjout()));
            $news->setDateModif(new \DateTime($news->dateModif()));
        }

        $requete->closeCursor();

        return $listeNews;
    }
}