<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mon blog</title>
        <link href="public/css/style.css" rel="stylesheet" /> 
    </head>
        
    <body>
        <h1>Signaler un commentaire inapproprié</h1>
        <p><a href="index.php?action=post&amp;id=<?=$_GET['id']?>">Retour à l'article</a></p>


		<p></p>
		
		<?php
		if (isset($_GET['comment'])) {
		?>	
		<p>Souhaitez-vous vraiment signaler ce commentaire ?</p>
			<a href="index.php?action=report&amp;id=<?=$_GET['id']?>&amp;reported=<?=$_GET['comment']?>"><input type="button" value="Oui" /></a>
			<a href="index.php?action=post&amp;id=<?=$_GET['id']?>"><input type="button" value="Non" /></a>
		<?php
		} else {
		?>
			<p>Commentaire signalé au modérateur</p>	
		<?php
		}
		
		?>
		