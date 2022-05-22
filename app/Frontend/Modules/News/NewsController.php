<?php

namespace Applications\Frontend\Modules\News;

class NewsController extends \Library\BackController
{
    public function executeIndex(\Library\HTTPRequest $request)
    {
        $nombreNews = $this->app->config()->get('nombre_news');
        $nombreCaracteres = $this->app->config()->get('nombre_carateres');

        $this->page->addVar('title', 'Liste des ' . $nombreNews . ' dernières news');

        $manager = $this->managers->getManagerOf('Connexion');

        $listeNews = $manager->getList(0, $nombreNews);

        foreach ($listeNews as $news)
        {
            if (strlen($news->contenu()) > $nombreCaracteres) {
                $debut = substr($news->contenu(), 0, $nombreCaracteres);
                $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
                $news->setContenu($debut);
            }
        }

        $this->page->addVar('listeNews', $listeNews);
    }

    public function executeShow(\Library\HTTPRequest $request)
    {
        $news = $this->managers->getManagerOf('Connexion')->getUnique($request->getData('id'));
        if (empty($news)) {
            $this->app->httpResponse()->redirect404();
        }

        $this->page->addVar('title', $news->titre());
        $this->page->addVar('news', $news);
        $this->page->addVar('comments', $this->managers->getManagerOf('Comment')->getListOf($news->id()));
    }

    public function executeInsertComment(\library\HTTPRequest $request)
    {
        $this->page->addVar('title', 'Ajout d\'un commentaire');
        if ($request->postExists('pseudo')) {
            $comment = new \Library\Entities\Comment(array(
                'news' => $request->getData('news'),
                'auteur' => $request->postData('pseudo'),
                'contenu' => $request->postData('contenu')
            ));
            if ($comment->isValid()) {
                $this->managers->getManagerOf('Comment')->save($comment);
                $this->app->user()->setFlash('Le commentaire a bien été ajouté, merci!');
                $this->app->httpResponse()->redirect('news-' . $request->getData('news') . '.html');
            }
            else {
                $this->page->addVar('erreurs', $comment->erreurs());
            }
            $this->page->addVar('comment', $comment);
        }
    }
}