<h2>Ajouter un commentaire</h2>
<form action="" method="post">
    <p>
        <?php
        if (isset($erreurs) && in_array(\Library\Entities\Comment::AUTEUR_INVALIDE, $erreurs)) {
            echo 'L\'auteur est invalide.<br>';
        }
        ?>
            <label>Pseudo</label>
            <input type="text" name="pseudo" value="
            <?php 
            if (isset($comment)) {
                echo htmlspecialchars($comment['auteur']); 
            }    
            ?>"><br>
        <?php
        if (isset($erreurs) && in_array(\Library\Entities\Comment::CONTENU_INVALIDE, $erreurs)) {
            echo 'Le contenu est invalide.<br>';
        }
        ?>
        <label>Contenu</label>
        <textarea name="contenu" cols="50" rows="7">
            <?php
            if (isset($comment)) {
                echo htmlspecialchars($comment['contenu']);
            }
            ?>
        </textarea><br>
        <input type="submit" value="Commenter">
    </p>
</form>