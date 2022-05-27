<?php

namespace Applications\Frontend\Modules\News;

use Library\BackController;
use Library\Entities\Comment;
use Library\Entities\News;
use Library\Form;
use Library\FormBuilder\CommentFormBuilder;
use Library\FormHandler;
use Library\HTTPRequest;
use Library\NewsFormBuilder;
use Library\StringField;

class NewsController extends BackController
{
    /**
     * @param HTTPRequest $request
     * @return void
     */
    public function executeIndex(HTTPRequest $request): void
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

    /**
     * @param HTTPRequest $request
     * @return void
     */
    public function executeShow(HTTPRequest $request): void
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

    /**
     * @param HTTPRequest $request
     * @return void
     */
    public function executeInsertComment(HTTPRequest $request): void
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

        $formHandler = new FormHandler($form, $this->managers->getManagerOf('Comments'), $request);

        if ($formHandler->process()) {
            $this->managers->getManagerOf('Comments')->save($comment);
            $this->app->user()->setFlash('Le commentaire a bien été ajouté, merci!');
            $this->app->httpResponse()->redirect('news-' . $request->getData('news') . '.html');
        }

        $this->page->addVar('comment', $comment);
        $this->page->addVar('form', $form->createView());
        $this->page->addVar('title', 'Ajout d\'un commentaire');
    }

    /**
     * @param HTTPRequest $request
     * @return void
     */
    public function executeInsert(HTTPRequest $request): void
    {
        $this->processForm($request);
        $this->page->addVar('title', 'Ajout d\'une news');
    }

    /**
     * @param HTTPRequest $request
     * @return void
     */
    public function executeUpdate(HTTPRequest $request): void
    {
        $this->processForm($request);
        $this->page->addVar('title', 'Modification d\'une news');
    }

    /**
     * @param HTTPRequest $request
     * @return void
     */
    public function executeUpdateComment(HTTPRequest $request): void
    {
        $this->page->addVar('title', 'Modification d\'un commentaire');
        if ($request->method() == 'POST') {
            $comment = new Comment(array(
                'id' => $request->getData('id'),
                'auteur' => $request->postData('auteur'),
                'contenu' => $request->postData('contenu')
            ));
        } else {
            $comment = $this->managers->getManagerOf('Comments')->get($request->getData('id'));
        }

        $formBuilder = new CommentFormBuilder($comment);
        $formBuilder->build();
        $form = $formBuilder->form();

        $formHandler = new FormHandler($form, $this->managers->getManagerOf('Comments'), $request);

        if ($formHandler->process()) {
            $this->managers->getManagerOf('Comments')->save($comment);
            $this->app->user()->setFlash('Le commentaire a bien été modifié');
            $this->app->httpResponse()->redirect('/admin/');
        }
        $this->page->addVar('form', $form->createView());
    }

    public function processForm(HTTPRequest $request)
    {
        if ($request->method() == 'POST') {
            $news = new News(array(
                'auteur' => $request->postData('auteur'),
                'titre' => $request->postData('titre'),
                'contenu' => $request->postData('contenu')
            ));
            if ($request->getExists('id')) {
                $news->setId($request->getData('id'));
            }
        } else {
            if ($request->getExists('id')) {
                $news = $this->managers->getManagerOf('News')->getUnique($request->getData('id'));
            } else {
                $news = new News;
            }
        }

        $formBuilder = new NewsFormBuilder($news);
        $formBuilder->build();

        $form = $formBuilder->form();

        $formHandler = new FormHandler($form, $this->managers->getManagerOf('News'), $request);

        if ($formHandler->process()) {
            $this->managers->getManagerOf('News')->save($news);
            $this->app->user()->setFlash($news->isNew() ? 'La news a bien été ajouté !' : 'La news a bien été modifiée !');
        }

        $this->page->addVar('form', $form->createView());
    }
}