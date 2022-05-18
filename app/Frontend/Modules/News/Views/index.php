<?php
foreach ($listeNews as $news)
{
?>
<h2><a href="news-<?php echo $news['id']; ?>.html"><?php echo $news['titre']; ?></a></h2>
<p><?php echo nl2br($news['contenu']); ?></p>
<?
}
?>