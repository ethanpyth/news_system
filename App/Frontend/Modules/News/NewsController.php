<?php

namespace Applications\Frontend\Modules\News;

use Library\BackController;
use Library\Entities\Comment;
use Library\Form;
use Library\FormBuilder\CommentFormBuilder;
use Library\HTTPRequest;
use Library\StringField;

class NewsController extends BackController
{
    public function executeIndex(HTTPRequest $request)
    {
        $nombreNews = $this->app->config()->get('nombre_news');
        $nombreCaracteres = $this->app->config()->get('nombre_carateres');

        $this->page->addVar('title', 'Liste des ' . $nombreNews . ' dernières news');

        $manager = $this->managers->getManagerOf('Connexion');

        $listeNews = $manager->getList(0, $nombreNews);

        foreach ($listeNews as $news) {
            if (strlen($news->contenu()) > $nombreCaracteres) {
                $debut = substr($news->contenu(), 0, $nombreCaracteres);
                $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
                $news->setContenu($debut);
            }
        }

        $this->page->addVar('listeNews', $listeNews);
    }

    public function executeShow(HTTPRequest $request)
    {
        $news = $this
            ->managers
            ->getManagerOf('Connexion')
            ->getUnique($request->getData('id'));
        if (empty($news)) {
            $this->app->httpResponse()->redirect404();
        }

        $this->page->addVar('title', $news->titre());
        $this->page->addVar('news', $news);
        $this->page->addVar(
            'comments', $this
                ->managers
                ->getManagerOf('Comment')
                ->getListOf($news->id())
        );
    }

    public function executeInsertComment(HTTPRequest $request)
    {
        if ($request->method() == 'POST') {
            $comment = new Comment(array(
                'news' => $request->getData('news'),
                'auteur' => $request->postData('auteur'),
                'contenu' => $request->postData('contenu')
            ));
        } else {
            $comment = new Comment;
        }

        $formBuilder = new CommentFormBuilder($comment);
        $formBuilder->build();

        $form = $formBuilder->form();

        if ($request->method() == 'POST' && $form->isValid()) {
            $this->managers->getManagerOf('Comments')->save($comment);
            $this->app->user()->setFlash('Le commentaire a bien été ajouté, merci!');
            $this->app->httpResponse()->redirect('news-' . $request->getData('news') . '.html');
        }
        $this->page->addVar('comment', $comment);
        $this->page->addVar('form', $form->createView());
        $this->page->addVar('title', 'Ajout d\'un commentaire');
    }
}