<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="public/css/style.css">
		<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">

		<link href="public/bootstrap/css/bootstrap.min.css" rel="stylesheet">

		<link rel="icon" type="image/png" href="http://lafondationphoenix.com/JeanForteroche/public/images/favicon.png" />

		<title>Billet simple pour l'Alaska</title>
	</head>
	<body>

		<?php
        include "View/frontend/header.php";
        include "View/frontend/lateralBar.php";
        ?>

		<div class="hidden-lg hidden-md hidden-sm col-xs-12 mobile-menu">
			<?php
            include "View/frontend/mobileMenu.php";
            ?>
		</div>

		<div class="col-lg-2 col-lg-pull-1 col-md-2 col-md-pull-1 col-sm-3 col-sm-pull-2 hidden-xs first-panel first-panel-front">
			<?php
            include "View/frontend/firstPanel.php";
        ?>
		</div>

		<div class="col-lg-5 col-md-5 col-sm-5 col-sm-pull-2 col-xs-12 second-panel second-panel-front">
			<?php
            include "View/frontend/secondPanel.php";
        ?>
		</div>


		<?php
        include "View/frontend/visitorCounter.php";
        include "View/frontend/footer.php";
        ?>

		<!-- JAVASCRIPT -->

		<!-- FONT AWESOME SCRIPT -->

		<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
	</body>
</html>
