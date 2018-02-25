<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mon blog</title>
        <link href="public/css/style.css" rel="stylesheet" /> 
    </head>
        
    <body>
    	<div class="centered-box">
	        <h4>Signaler un commentaire <span><i class="fas fa-comments"></i></span> inapproprié</h4>
			<?php
			if (isset($_GET['comment'])) {
				?>	
				<p>Souhaitez-vous vraiment signaler ce commentaire ?</p>
				<p><?= $comment->getAuthor() ?></p>
				<a href="index.php?action=report&amp;id=<?=$_GET['id']?>&amp;reported=<?=$_GET['comment']?>&amp;ticket=<?=$_GET['ticket']?>&amp;episode=<?= $_GET['episode'] ?>"><input type="button" value="Oui" /></a>
				<a href="index.php?ticket=<?=$_GET['ticket']?>&amp;episode=<?= $_GET['episode'] ?>"><input type="button" value="Non" /></a>
			<?php
			} else {
				?>
				<p><a href="index.php?ticket=<?=$_GET['ticket']?>&amp;episode=<?= $_GET['episode'] ?>">Retour</a></p>
				<p>Commentaire signalé au modérateur</p>	
			<?php
			}
		?>
		</div>
		<!-- FONT AWESOME SCRIPT -->
		
	<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
</body>