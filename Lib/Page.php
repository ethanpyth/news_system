<?php

namespace Library;

class Page extends ApplicationComponent
{
    protected $contentFile;
    protected array $vars = array();

    public function addVar($var, $value)
    {
        if (!is_string($var) || is_numeric($var) || empty($var)) {
            throw new \InvalidArgumentException('Le nom de la variable doit etre une chaine de caractère non nulle');
        }
        $this->vars[$var] = $value;
    }

    public function getGeneratedPage(): bool|string
    {
        if (!file_exists($this->contentFile)) {
            throw new \RuntimeException('La vue spécifié n\'éxiste pas');
        }

        $user = $this->app->user();

        extract($this->vars);
        ob_start();
        require $this->contentFile;
        $content = ob_get_clean();
        ob_start();
        require dirname(__FILE__) . '/../app/' . $this->app->name() . '/Templates/layout.php';
        return ob_get_clean();
    }

    public function setContentFile($contentFile)
    {
        if (!is_string($contentFile) || empty($contentFile)) {
            throw new \InvalidArgumentException('La vue spécifiéest invalide');
        }

        $this->contentFile = $contentFile;
    }
}