<?php

namespace Library\FormBuilder;

use Library\FormBuilder;
use Library\MaxLengthValidator;
use Library\NotNullValidator;
use Library\StringField;
use Library\TextField;

class CommentFormBuilder extends FormBuilder
{
    public function build()
    {
        $this->form->add(new StringField(array(
            'label' => 'Auteur',
            'name' => 'auteur',
            'maxLength' => 50,
            'validators' => array(
                new MaxLengthValidator('L\'auteur spécifié est trop long (50 caractères maximum)', 50),
                new NotNullValidator('Merci de spécifier l\'auteur du commentaire'),
            )
        )))->add(\Library\TextField(array(
            'label' => 'Contenu',
            'name' => 'contenu',
            'rows' => 7,
            'cols' => 50,
            'validators' => array(
                new NotNullValidator('Merci de spécifier votre commentaire')
            )
        )));
    }
}