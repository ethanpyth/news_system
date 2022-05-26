<h2>Ajouter un commentaire</h2>
<form action="" method="post">
    <p>
        <?php
        use Library\MaxLengthValidator;
        use Library\NotNullValidator;

        echo $form->add(new \Library\StringField(array(
            'label' => 'Auteur',
            'name' => 'auteur',
            'maxlength' => 50,
            'validators' => array(
                new MaxLengthValidator('L\'auteur spécifié est trop long (50 caractères maximum)', 50),
                new NotNullValidator('Merci de spécifier l\'auteur du commentaire')
            )
        )));
        ?>

        <input type="submit" value="Commenter">
    </p>
</form>