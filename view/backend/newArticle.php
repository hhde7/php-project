<?php
	require_once('model/PostManager.php');
	$postManager = new  JeanForteroche\Blog\Model\PostManager();

	if ($_GET['action'] == 'episode') {
		$type = 'nouvel épisode <i class="fab fa-envira"></i> 
';
	}
	elseif ($_GET['action'] == 'ticket') {
		$type = 'nouveau billet <i class="fas fa-bullhorn"></i>';
	}
?>





<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="public/css/style.css">
		<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
		
		<link href="public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<title>Rédaction d'un <?= $type ?></title>
</head>
<body>
	<?php
		include('view/frontend/header.php');
		include('view/backend/lateralBar.php');
	?>
	<div class="col-lg-4"> 	
	<form action="index.php?action=<?= $_GET['action'] ?>&amp;posted=<?= $_GET['action'] ?>" method="post">
            <div>
                <label for="author">Titre</label><br />
                <input type="text" id="title" name="title" />
            </div>
            <div>
                <label for="comment">Contenu du <?= $type ?></label><br />
                <textarea class="tinymce" id="writer" name="content" rows="25"></textarea>
            </div>
            <div>
                <input type="submit" />
            </div>
        </form>
	<?php


	
		
	?>
	</div>

	<!-- JAVASCRIPT -->
	<!-- FONT AWESOME SCRIPT -->
		
	<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

	<!-- TINYMCE SCRIPTS -->
	<script type="text/javascript" src="http://localhost/test/jeanforteroche/plugins/tinymce/js/jquery.min.js"></script>
	<script type="text/javascript" src="http://localhost/test/jeanforteroche/plugins/tinymce/plugin/tinymce.min.js"></script>
	<script type="text/javascript" src="http://localhost/test/jeanforteroche/plugins/tinymce/plugin/init-tinymce.js"></script>


</body>

</html>