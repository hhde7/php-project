<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="utf-8">
		<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">


		<link rel="stylesheet" type="text/css" href="public/css/style.css">

		<link rel="icon" type="image/png" href="http://lafondationphoenix.com/JeanForteroche/public/images/favicon.png" />

		<title>Billet simple pour l'Alaska</title>
	</head>

    <body>
    	<div class="centered-box">
	        <h4>Signaler un commentaire <span><i class="fas fa-comments"></i></span> inapproprié</h4>
			<?php
            if (isset($_GET['comment'])) {
                ?>
				<p>Souhaitez-vous vraiment signaler ce commentaire ?</p>
				<p><?= $comment->getAuthor() ?></p>
				<a href="index.php?action=report&amp;id=<?= htmlspecialchars($_GET['id']) ?>&amp;reported=<?= htmlspecialchars($_GET['comment']) ?>&amp;ticket=<?= htmlspecialchars($_GET['ticket']) ?>&amp;episode=<?= htmlspecialchars($_GET['episode']) ?>"><input type="button" value="Oui" /></a>
				<a href="index.php?ticket=<?= htmlspecialchars($_GET['ticket']) ?>&amp;episode=<?= htmlspecialchars($_GET['episode']) ?>"><input type="button" value="Non" /></a>
			<?php
            } else {
                ?>
				<p><a href="index.php?ticket=<?= htmlspecialchars($_GET['ticket']) ?>&amp;episode=<?= htmlspecialchars($_GET['episode']) ?>">Retour</a></p>
				<p>Commentaire signalé au modérateur</p>
			<?php
            }
        ?>
		</div>
		<!-- FONT AWESOME SCRIPT -->

		<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
	</body>
</html>
