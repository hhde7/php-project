 <!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mon blog</title>
        <link href="public/css/style.css" rel="stylesheet" /> 
    </head>
    <body>
       
	<div class="centered-box">
<?php
		if ($_GET['from'] == 'allEpisodes') {
			$type = 'épisode <i class="fab fa-envira"></i>';
			$episode = $postManager->getPost($_GET['delete']);
			$element = $episode->getTitle();
		}
		elseif ($_GET['from'] == 'allTickets') {
			$type = 'billet <i class="fas fa-bullhorn"></i>';
			$ticket = $postManager->getPost($_GET['delete']);
			$element = $ticket->getTitle();
		}
		elseif ($_GET['from'] == 'allComments') {
			$type = 'commentaire <i class="fas fa-comments"></i>';
		}
		elseif ($_GET['from'] == 'reportedComments') {
			$type = 'commentaire <i class="fas fa-comments"></i>';
		} 
		elseif ($_GET['from'] == 'dashboard') {
			$type = 'commentaire <i class="fas fa-comments"></i>';
		}
		?>
		<h4>Modérer un <?= $type ?> inapproprié</h4>
		<?php
		$action = $_GET['action'];
		if (isset($_GET['allow']) AND $_GET['allow'] > 0) {
		?>	

        
			<p>Souhaitez-vous vraiment accepter le <?= $type ?> ?</p>
				<?php
				if ($_GET['from'] == 'dashboard') {
					$comment = $commentManager->getComment($_GET['allow']);
					$element = $comment->getAuthor();	
				?>
					<p><?= $element ?></p>
					<a href="index.php?action=<?= $action ?>&amp;allow=<?=$_GET['allow']?>&amp;confirm=allow&amp;from=dashboard"><input type="button" value="Oui" /></a>
					<a href="index.php?action=dashboard"><input type="button" value="Non" /></a>
				<?php
				}
				elseif ($_GET['from'] == 'reportedComments') {
					$comment = $commentManager->getComment($_GET['allow']);
					$element = $comment->getAuthor();
				?>
					<p><?= $element ?></p>
					<a href="index.php?action=<?= $action ?>&amp;allow=<?=$_GET['allow']?>&amp;confirm=allow&amp;from=reportedComments&amp;page=<?= $_GET['page'] ?>"><input type="button" value="Oui" /></a>
					<a href="index.php?action=reportedComments&amp;page=<?= $_GET['page'] ?>"><input type="button" value="Non" /></a>
				<?php
				}
			} elseif (isset($_GET['delete']) AND $_GET['delete'] > 0) {
			?>

			<p>Souhaitez-vous vraiment supprimer cet élément ?</p>
				<?php
				if ($_GET['from'] == 'dashboard') {
					$comment = $commentManager->getComment($_GET['delete']);
					$element = $comment->getAuthor();	
				?>
					<p><?= $element ?></p>
					<a href="index.php?action=<?= $action ?>&amp;delete=<?=$_GET['delete']?>&amp;confirm=delete&amp;from=dashboard"><input type="button" value="Oui" /></a>
					<a href="index.php?action=dashboard"><input type="button" value="Non" /></a>
				<?php
				}
				elseif ($_GET['from'] == 'allEpisodes') {
				?>
					<p><?= $element ?></p>
					<a href="index.php?action=<?= $action ?>&amp;delete=<?=$_GET['delete']?>&amp;confirm=delete&amp;from=allEpisodes&amp;page=<?= $_GET['page'] ?>"><input type="button" value="Oui" /></a>
					<a href="index.php?action=allEpisodes&amp;page=<?= $_GET['page'] ?>"><input type="button" value="Non" /></a>
				<?php
				}
				elseif ($_GET['from'] == 'allTickets') {
				?>
					<p><?= $element ?></p>
					<a href="index.php?action=<?= $action ?>&amp;delete=<?=$_GET['delete']?>&amp;confirm=delete&amp;from=allTickets&amp;page=<?= $_GET['page'] ?>"><input type="button" value="Oui" /></a>
					<a href="index.php?action=allTickets&amp;page=<?= $_GET['page'] ?>"><input type="button" value="Non" /></a>
				<?php
				}
				elseif ($_GET['from'] == 'allComments') {
					$comment = $commentManager->getComment($_GET['delete']);
					$element = $comment->getAuthor();	
				?>
					<p><?= $element ?></p>
					<a href="index.php?action=<?= $action ?>&amp;delete=<?=$_GET['delete']?>&amp;confirm=delete&amp;from=allComments&amp;page=<?= $_GET['page'] ?>"><input type="button" value="Oui" /></a>
					<a href="index.php?action=allComments&amp;page=<?= $_GET['page'] ?>"><input type="button" value="Non" /></a>
				<?php
				}
				elseif ($_GET['from'] == 'reportedComments') {
					$comment = $commentManager->getComment($_GET['delete']);
					$element = $comment->getAuthor();	
				?>
					<p><?= $element ?></p>
					<a href="index.php?action=<?= $action ?>&amp;delete=<?=$_GET['delete']?>&amp;confirm=delete&amp;from=reportedComments&amp;page=<?= $_GET['page'] ?>"><input type="button" value="Oui" /></a>
					<a href="index.php?action=reportedComments&amp;page=<?= $_GET['page'] ?>"><input type="button" value="Non" /></a>
				<?php
				}
				?>

			<?php	
			} else {
			?>
				<p>bug</p>	
			<?php
			}
			?>	

	</div>
			<!-- FONT AWESOME SCRIPT -->
		
	<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
</body>