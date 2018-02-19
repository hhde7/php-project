<?php

require_once('model/CommentManager.php');

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
		
		
		<div class="col-lg-2 col-lg-pull-1 second-panel">
		<?php
		include('view/frontend/firstPanel.php');
		?>
		</div>

		<div class="col-lg-5  second-panel">
		<?php
		include('view/frontend/secondPanel.php');
		?>
		</div>




		
		
	<?php
    include('view/frontend/footer.php');
    ?>
		
		<!-- JAVASCRIPT -->

		<!-- FONT AWESOME SCRIPT -->
		
		<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
	</body>
	
	
</html>