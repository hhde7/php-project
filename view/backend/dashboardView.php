<?php

require_once('model/CommentManager.php');
require_once('model/CounterManager.php');


$commentManager = new JeanForteroche\Blog\Model\CommentManager;
$postManager = new JeanForteroche\Blog\Model\PostManager;
$counterManager = new JeanForteroche\Blog\Model\CounterManager;

?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="public/css/style.css">
		<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
		<link href="public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	
		<title>Tableau de bord</title>
	</head>
	<body>
		 
		<div class="col-lg-12">
			<a href="index.php"><img id="logo" src="public/images/logo_02.png"/></a>
		</div>
		
		<div class="col-lg-3" id="menu">
			<?php
			include('menu.php');
			?>
		</div>

		<div class="col-lg-3">
			<p class="blockTitle" id="lastEpisode">Dernier épisode publié</p>
			
			<div class="blockElt">
			<?php 
			include('lastEpisode.php');
			?>
			</div>

			<p class="blockTitle" id="lastTicket">Dernier billet publié</p>

			<div class="blockElt">
			<?php 
			include('lastTicket.php');
			?>
			</div>
		</div>
		
		<div class="col-lg-3">
			<p class="blockTitle" id="lastComments">Commentaires récents</p>

			<div class="blockElt">
			<?php 
			include('lastComments.php');
			?>
			</div>

			<p class="blockTitle" id="reportedComments">Commentaires soumis à modération</p>

			<div class="blockElt">
			<?php 
			include('reportedComments.php');
			?>
			</div>
		</div>

		<div class="col-lg-3">
			<p class="blockTitle" id="postsStats">Statistiques sur mes articles</p>

			<div class="blockElt">
			<?php 
			include('postsStats.php');
			?>
			</div>

			<p class="blockTitle" id="readersStats">Statistiques sur mes lecteurs</p>

			<div class="blockElt">
			<?php 
			include('readersStats.php');
			?>
			</div>
		</div>
		
		<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
		
		
		<!-- TINYMCE SCRIPTS -->
		<script type="text/javascript" src="http://localhost/test/jeanforteroche/plugins/tinymce/js/jquery.min.js"></script>
		<script type="text/javascript" src="http://localhost/test/jeanforteroche/plugins/tinymce/plugin/tinymce.min.js"></script>
		<script type="text/javascript" src="http://localhost/test/jeanforteroche/plugins/tinymce/plugin/init-tinymce.js"></script>

	</body>
	<?php
    include('view/frontend/footer.php');
    ?>
</html>