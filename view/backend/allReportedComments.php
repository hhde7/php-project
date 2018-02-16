<?php
	require_once('model/PostManager.php');
	$commentManager = new  JeanForteroche\Blog\Model\CommentManager();
	$postManager = new JeanForteroche\Blog\Model\PostManager();
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="public/css/style.css">
		<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
		
		<link href="public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<title>Tous les commentaires</title>
</head>
<body>
	<?php
		include('view/frontend/header.php');
		include('view/backend/lateralBar.php');
	?>
	<div class="col-lg-4 first-panel"> 	
	<?php
		
			$reportedComment = $commentManager->getAllReportedComments();
			foreach ($reportedComment as $key => $value) {
			?>
				<p><?= $value->getAuthor() . ' ' . $value->getComment() . ' ' . $value->getCommentDate() ?> 
					<a href="index.php?action=reportedComments&amp;see=<?= $value->getCommentId() ?>" title="Voir"><i class="fas fa-eye"></i></a>
					<a href="index.php?action=moderate&amp;allow=<?= $value->getCommentId() ?>&amp;from=reportedComments" title="Modifier"><i class="fas fa-check"></i></a>
					<a href="index.php?action=moderate&amp;delete=<?= $value->getCommentId() ?>&amp;from=reportedComments" title="Supprimer"><i class="far fa-trash-alt"></i></a>
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