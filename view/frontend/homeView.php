<?php

require_once('model/CommentManager.php');

$postManager = new JeanForteroche\Blog\Model\PostManager;

?>

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
		include('view/frontend/header.php');
		include('view/frontend/lateralBar.php');
		?>
		<div class="col-lg-4 col-lg-pull-1 first-panel">
		<?php
		include('view/backend/firstPanel.php');
		?>
		</div>

		<div class="col-lg-4 second-panel">
		<?php
		include('view/backend/firstPanel.php');
		?>
		</div>
		


		<!-- JAVASCRIPT -->

		<!-- FONT AWESOME SCRIPT -->
		
		<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
		
		
		
	</body>
	
	<?php
    include('view/frontend/footer.php');
    ?>
	
</html>