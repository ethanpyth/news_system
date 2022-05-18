<p>
    Par <em><?php echo $news['auteur']; ?></em>, le 
    <?php echo $news['dateAjout']->format('d/m/Y à H/hi'); ?>
</p>
<h2>
    <?php echo $news['titre']; ?>
</h2>
<p><?php echo nl2br($news['contenu']); ?></p>

<?php
if ($news['dateAjout'] != $news['dateModif']) {
    ?>
    <p style="text-align: right;">
        <small>
            <em>
                Modifié le <?php echo $news['dateModif']->format('d/m/Y à H/hi'); ?>
            </em>
        </small>
    </p>
    <?php
}
