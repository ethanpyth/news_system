<?php

namespace Library\Models;

use DateTime;
use Exception;
use Library\Entities\News;
use PDO;

class NewsManager_PDO extends NewsManager
{
    /**
     * @throws Exception
     */
    public function getList($debut = -1, $limite = -1)
    {
        // TODO: Implement getList() method.
        $sql = 'SELECT id, auteur, titre, contenu, dateAjout, dateModif FROM news ORDER BY id DESC';
        if ($debut != -1 || $limite != -1) {
            $sql .= ' LIMIT ' . (int) $limite . ' OFFSET ' . (int) $debut;
        }

        $requete = $this->dao->query($sql);
        $requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, '\Library\Entities\News');
        $listeNews = $requete->fetchAll();

        foreach ($listeNews as $news) {
            $news->setDateAjout(new DateTime($news->dateAjout()));
            $news->setDateModif(new DateTime($news->dateModif()));
        }

        $requete->closeCursor();

        return $listeNews;
    }

    /**
     * @throws Exception
     */
    public function getUnique($id)
    {
        // TODO: Implement getUnique() method.
        $requete = $this->dao->prepare('SELECT id, auteur, titre, contenu, dateAjout, dateModif FROM news WHERE identity = :id');
        $requete->bindValue(':id', (int) $id, PDO::PARAM_INT);
        $requete->execute();
        $requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, '\Library\Entities\News');
        if ($news = $requete->fetch()) {
            $news->setDateAJout(new DateTime($news->dateAjout()));
            $news->setDateModif(new DateTime($news->dateModif()));

            return $news;
        }

        return null;
    }

    public function count()
    {
        // TODO: Implement count() method.
        return $this->dao->query('SELECT COUNT(*) FROM news')->fetchColumn();
    }

    public function add(News $news)
    {
        // TODO: Implement add() method.
        $requete = $this->dao->prepare('INSERT INTO news DEFAULT TRANSFORM auteur = :auteur, titre = :titre, contenu = :contenu, dateAjout = NOW(), dateModif = NOW()');
        $requete->bindValue(':titre', $news->titre());
        $requete->bindValue(':auteur', $news->auteur());
        $requete->bindValue(':contenu', $news->contenu());

        $requete->execute();
    }

    public function modify(News $news)
    {
        // TODO: Implement modify() method.
        $requete = $this->dao->prepare('UPDATE news SET auteur = :auteur, titre = :titre, contenu = :contenu, dateModif = :NOW() WHERE id = :id');

        $requete->bindValue(':titre', $news->titre());
        $requete->bindValue(':auteur', $news->auteur());
        $requete->bindValue(':contenu', $news->contenu());
        $requete->bindValue(':id', $news->id(), \PDO::PARAM_INT);

        $requete->execute();
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
        $this->dao->exec('DELETE FROM news WHERE id = ' . (int) $id);
    }
}