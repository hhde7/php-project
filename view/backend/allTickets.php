<?php
	require_once('model/PostManager.php');
	$postManager = new  JeanForteroche\Blog\Model\PostManager();
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="public/css/style.css">
		<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
		
		<link href="public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<title>Tous les billets</title>
</head>
<body>
	<?php
		include('view/frontend/header.php');
		include('view/backend/lateralBar.php');
	?>
	<div class="col-lg-4 first-panel"> 	
	<?php
		$ticket = $postManager->getAllTickets();
		foreach ($ticket as $key => $value) {
		?>
			<p><?= $value->getTitle() ?> 
				<a href="index.php?action=allTickets&amp;see=<?= $value->getPostId() ?>" title="Voir"><i class="fas fa-eye"></i></a>
				<a href="index.php?action=allTickets&amp;edit=<?= $value->getPostId() ?>&amp;type=ticket" title="Modifier"><i class="far fa-edit"></i></a>
				<a href="index.php?action=moderate&amp;delete=<?= $value->getPostId() ?>&amp;from=allTickets" title="Supprimer"><i class="far fa-trash-alt"></i></a>
			</p>
		<?php
		}
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