<form action="" method="post">
    <p>
        <?php
        if (isset($erreurs) && in_array(\Library\Entities\Comment::AUTEUR_INVALIDE, $erreurs)) {
            echo 'L\'auteur est invalide.<br>';
        }
        ?>
        <label>Pseudo</label>
        <input type="text" value="
        <?php echo htmlspecialchars($comment['auteur']); ?>
        "><br>
        <?php 
        if (isset($erreurs) && in_array(\Library\Entities\Comment::CONTENU_INVALIDE, $erreurs)) {
            echo 'Le contenu est invalide.<br>';
        }
        ?>
        <label>Contenu</label>
        <textarea name="contenu" id="" cols="50" rows="7">
            <?php echo htmlspecialchars($comment['contenu']); ?>
        </textarea>
        <input type="hidden" name="news" value="
        <?php echo $comment['news']; ?>">
        <input type="submit" value="Modifier">
    </p>
</form>
<?php
?>