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

		<h2 class="first-panel-title">TOUS LES COMMENTAIRES SIGNALÉS <i class="fas fa-comments"></i></h2>

		<img src="public/images/chain1.png" class="left-chain"> 	
		<img src="public/images/chain1.png" class="right-chain">
		<img src="public/images/nail1.png" class="left-nail">
		<img src="public/images/nail1.png" class="right-nail">

		<table>
			<tr>
				<th>AUTEUR</th>		
				<th>COMMENTAIRE</th>
				<th>DATE DE PUBLICATION</th>
				<th>ACTION</th>
			</tr>
	<?php
		
			$reportedComment = $commentManager->getAllReportedComments();
			foreach ($reportedComment as $key => $value) {
			?>
			<tr>
				<td><?= $value->getAuthor() ?></td> 
				<td><?= mb_strimwidth($value->getComment(), 0, 35, '...') ?></td>
				<td><?= mb_strimwidth($value->getCommentDate(), 4, 18)?></td> 
				<td><a href="index.php?action=reportedComments&amp;see=<?= $value->getCommentId() ?>" title="Voir"><i class="fas fa-plus-circle"></i></a>
				<a href="index.php?action=moderate&amp;allow=<?= $value->getCommentId() ?>&amp;from=reportedComments" title="Accepter"><i class="fas fa-check-circle"></i></a>
			<a href="index.php?action=moderate&amp;delete=<?= $value->getCommentId() ?>&amp;from=reportedComments" title="Supprimer"><i class="fas fa-minus-circle"></i></a></td>
			</tr>
			<?php
			}
	?>
		</table>
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