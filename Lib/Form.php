<?php

namespace Library;

class Form
{
    protected $entity;
    protected $fields;

    public function __construct(Entity $entity)
    {
        $this->setEntity($entity);
    }

    public function add(Field $field): static
    {
        $attr = $field->name();
        $field->setValue($this->entity->$attr());
        $this->fields[] = $field;

        return $this;
    }

    public function createView(): string
    {
        $view = '';
        foreach ($this->fields as $field) {
            $view .= $field->buildWIdget() . '<br>';
        }

        return $view;
    }

    public function entity()
    {
        return $this->entity;
    }

    public function setEntity(Entity $entity): void
    {
        $this->entity = $entity;
    }

    public function isValid(): void
    {
    }
}