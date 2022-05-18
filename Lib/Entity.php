<?php

namespace Library;

use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;
use JetBrains\PhpStorm\Internal\TentativeType;
use ReturnTypeWillChange;

class Entity implements \ArrayAccess
{
    protected $id;
    protected array $erreurs = array();
    
    public function __construct(array $donnees = array())
    {
        if (!empty($donnees)) {
            $this->hydrate($donnees);
        }
    }

    public function isNew(): bool
    {
        return empty($this->id);
    }

    public function erreurs(): array
    {
        return $this->erreurs;
    }

    public function id()
    {
        return $this->id;
    }

    public function setId()
    {
        $this->id = (int) $id;
    }

    /**
     * @inheritDoc
     */
    public function offsetExists($offset): bool
    {
        // TODO: Implement offsetExists() method.

        return isset($this->$offset) && is_callable(array($this, $offset));
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($offset)
    {
        // TODO: Implement offsetGet() method.
        if (isset($this->$offset) && is_callable(array($this, $offset))) {
            return $this->$offset;
        }
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($offset, $value)
    {
        // TODO: Implement offsetSet() method.

        $method = 'set' . ucfirst($offset);

        if (isset($this->$offset) && is_callable(array($this, $method))) {
            $this->$method($value);
        }
    }

    /**
     * @inheritDoc
     */
    public function offsetUnset($offset)
    {
        // TODO: Implement offsetUnset() method.

        throw new \Exception('Impossible de supprimer une quelconque valeur');
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $attributs => $valeur)
        {
            $methode = 'set' . ucfirst($attributs);

            if (is_callable(array($this, $methode))) {
                $this->$methode($valeur);
            }
        }
    }
}