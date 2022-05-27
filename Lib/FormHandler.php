<?php

namespace Library;

class FormHandler
{
    protected $form;
    protected $manager;
    protected $request;

    public function __construct(Form $form, Manager $manager, HTTPRequest $request)
    {
        $this->setForm($form);
        $this->setManager($manager);
        $this->setRequest($request);
    }

    /**
     * @return bool
     */
    public function process(): bool
    {
        if ($this->request->method() == 'POST' && $this->form->isValid()) {
            $this->manager->save($this->form->entity());

            return true;
        }

        return false;
    }

    /**
     * @param mixed $form
     */
    public function setForm(Form $form): void
    {
        $this->form = $form;
    }

    /**
     * @param mixed $manager
     */
    public function setManager( $manager): void
    {
        $this->manager = $manager;
    }

    /**
     * @param mixed $request
     */
    public function setRequest(HTTPRequest $request): void
    {
        $this->request = $request;
    }
}