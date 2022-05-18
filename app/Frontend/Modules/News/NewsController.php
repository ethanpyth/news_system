<?php

namespace Applications\Frontend\Modules\News;

class NewsController extends \Library\BackController
{
    public function executeIndex(\Library\HTTPRequest $request)
    {
        $nombreNews = $this->app->config()->get('nombre_news');
        $nombreCaracteres = $this->app->config()->get('nombre_carateres');

        $this->page->addVar('title', 'Liste des ' . $nombreNews . ' dernières news');

        $manager = $this->managers->getManagerOf('News');

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
        $news = $this->managers->getManagerOf('News')->getUnique($request->getData('id'));
        if (empty($news)) {
            $this->app->httpResponse()->redirect404();
        }

        $this->page->addVar('title', $news->titre());
        $this->page->addVar('news', $news);
    }
}