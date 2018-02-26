<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="public/css/style.css">
		<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
		
		<link href="public/bootstrap/css/bootstrap.min.css" rel="stylesheet">

		<title>Billet simple pour l'Alaska</title>
	</head>
	<body>
		<?php
		include "view/frontend/header.php";
		?>
		<div class="hidden-lg hidden-md hidden-sm col-xs-12 mobile-menu">
			<?php
			include "view/frontend/mobileMenu.php";
		?>
		</div>
		<div class="hidden-lg hidden-md hidden-sm col-xs-12 mobile-list">
			<div class="col-xs-6">
				<p class="mobile-episode-title">LES ÉPISODES</p>
				<?php
				include "allEpisodesTitles.php";
			?>
			</div>
			<div class="col-xs-6">
				<?php
				include "profil.php";
			?>
			</div>
		</div>
		<?php
    	include "view/frontend/footer.php";
    	?>
		
		<!-- FONT AWESOME SCRIPT -->
		
		<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
	</body>
</html>