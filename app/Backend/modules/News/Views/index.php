<?php
?>
<p style="text-align: center;">Il y a actuellement <?php echo $nombreNews; ?> news. En voici la liste :</p>

<table>
    <tr>
        <th>Auteur</th><th>Titre</th><th>Date d'ajout</th><th>Dernière modification</th><th>Action</th>
    </tr>
    <?php
    foreach ($listeNews as $news) {
        echo '<tr><td>', $news['auteur'], '</td><td>', $news['titre'], '</td><td>', 
        $news['dateAjout']->format('d/m/Y à H\hi'), '</td><td>', 
        ($news['dateAjout'] == $news['dateModif'] ? '-' : 'le ' . $news['dateModif']->format('d/m/Y à H\hi')),
        '</td><td><a href="news-update-', $news['id'], '.html"><img src="/images/updates.png" alt="Modifier"></a> <a href="news-delete-', $news['id'],'.html"><img src="/images/delete.png" alt="Supprimer"></a></td></tr>', "\n";
    }
    ?>
</table>