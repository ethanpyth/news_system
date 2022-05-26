<?php

namespace Library;

class NewsFormBuilder extends FormBuilder
{
    public function build()
    {
        $this->form->add(new StringField(array(
            'label' => 'Auteur',
            'name' => 'auteur',
            'maxLength' => 20,
            'validators' => array(
                new MaxLengthValidator('L\'auteur spécifié est trop long (20 caractères maximum)', 20),
                new NotNullValidator('Merci de spécifier l\'auteur de la news'),
            ),
        )))
        ->add(new StringField(array(
            'label' => 'Titre',
            'name' => 'titre',
            'maxLength' => 100,
            'validators' => array(
                new MaxLengthValidator('le titre spécifié est trop long (100 caractères maximum)', 100),
            ),
        )))
        ->add(new TextField(array(
            'label' => 'Contenu',
            'name' => 'contenu',
            'rows' => 8,
            'cols' => 60,
            'validators' => array(
                new NotNullValidator('Merci de spécifier le contenu de la news'),
            ),
        )));
    }
}