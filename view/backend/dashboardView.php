<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="public/css/style.css">
		<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
		<link rel="icon" type="image/png" href="http://lafondationphoenix.com/jeanforteroche/public/images/favicon.png" />

		<link href="public/bootstrap/css/bootstrap.min.css" rel="stylesheet">

		<title>Tableau de bord</title>
	</head>
	<body>
		<div>
			<?php
            include "view/frontend/header.php";
        ?>
		<div>

		<div class="hidden-lg hidden-md hidden-sm col-xs-12 mobile-menu">
			<?php
            include "view/backend/mobileMenu.php";
            ?>
		</div>

		<div>
			<?php
            include "view/backend/lateralBar.php";
            ?>
		</div>

		<div class="col-lg-4 col-lg-pull-0 col-md-4 col-md-pull-0 col-sm-4 col-sm-pull-1 hidden-xs first-panel first-panel-back">
			<?php
            include "firstPanel.php";
        ?>
		</div>

		<div class="col-lg-4 col-lg-push-1 col-md-4 col-md-push-1 col-sm-4 col-sm-push-1 hidden-xs second-panel second-panel-back ">
			<?php
            include "secondPanel.php";
            ?>
		</div>

		<!-- JAVASCRIPT -->

		<!-- FONT AWESOME SCRIPT -->

		<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
	</body>
</html>
