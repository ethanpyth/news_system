<?php

namespace Library;

abstract class FormBuilder
{
    protected $form;

    public function __construct(Entity $entity)
    {
        $this->setForm(new Form($entity));
    }

    public function setForm(Form $form): void
    {
        $this->form = $form;
    }

    public function form()
    {
        return $this->form;
    }
}