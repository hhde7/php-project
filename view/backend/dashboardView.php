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
		 
		<?php
		include('view/frontend/header.php');
		?>
		
		<div class="col-lg-2" id="menu">
			<?php
			include('menu.php');
			?>
			<h2 id="postsStatsTitle">STATS SUR MES ARTICLES</h2>
			<img id="corner" src="public/images/corner.png" />
			<div id="postsStats">
				<?php 
				include('postsStats.php');
				?>
			</div>

			<h2 id="readersStatsTitle">STATS SUR MES LECTEURS</h2>
			<img id="corner" src="public/images/corner.png" />
			<div id="readersStats">
				<?php 
				include('readersStats.php');
				?>
			</div>
			
		</div>

		<div class="col-lg-5">
			<h2 id="lastEpisodeTitle">DERNIER ÉPISODE PUBLIÉ</h2>
			
			<div id="lastEpisode">
				<?php 
				include('lastEpisode.php');
				?>
			</div>

			<h2 id="lastTicketTitle">DERNIER BILLET PUBLIÉ</h2>

			<div id="lastTicket">
				<?php 
				include('lastTicket.php');
				?>
			</div>
		</div>
		
		<div class="col-lg-5">
			<h2 id="reportedCommentsTitle">COMMENTAIRES SIGNALÉS</h2>

			<div id="reportedComments">
				<?php 
				include('reportedComments.php');
				?>
			</div>
			<h2 id="lastCommentsTitle">COMMENTAIRES RÉCENTS</h2>

			<div id="lastComments">
				<?php 
				include('lastComments.php');
				?>
			</div>
		</div>
		<!--
		<div class="col-lg-2">
			<h2 id="postsStatsTitle">STATS SUR MES ARTICLES</h2>

			<div id="postsStats">
				<?php 
				include('postsStats.php');
				?>
			</div>

			<h2 id="readersStatsTitle">STATS SUR MES LECTEURS</h2>

			<div id="readersStats">
				<?php 
				include('readersStats.php');
				?>
			</div>
		</div>
		-->
		<!-- JAVASCRIPT -->

		<!-- FONT AWESOME SCRIPT -->
		
		<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
		
		
		<!-- TINYMCE SCRIPTS -->
		<script type="text/javascript" src="http://localhost/test/jeanforteroche/plugins/tinymce/js/jquery.min.js"></script>
		<script type="text/javascript" src="http://localhost/test/jeanforteroche/plugins/tinymce/plugin/tinymce.min.js"></script>
		<script type="text/javascript" src="http://localhost/test/jeanforteroche/plugins/tinymce/plugin/init-tinymce.js"></script>

	</body>
	<!--
	<?php
    include('view/frontend/footer.php');
    ?>
	-->
</html>