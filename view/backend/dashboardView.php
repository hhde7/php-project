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
		include('view/backend/lateralBar.php');
		?>
		
		<div class="col-lg-4 first-panel first-panel-back">
			<?php 
			include('firstPanel.php');
			?>
		</div>


		<div class="col-lg-4 col-lg-push-1 second-panel second-panel-back">
			<?php 
			include('secondPanel.php');
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