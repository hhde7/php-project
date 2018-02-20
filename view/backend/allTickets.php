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

		<h2 class="first-panel-title">TOUS LES BILLETS <i class="fas fa-bullhorn"></i></h2>

		<img src="public/images/chain1.png" class="left-chain"> 	
		<img src="public/images/chain1.png" class="right-chain">
		<img src="public/images/nail1.png" class="left-nail">
		<img src="public/images/nail1.png" class="right-nail">

		<table>
			<tr>
				<th>TITRE</th>		
				<th>DATE DE PUBLICATION</th>
				<th>ACTION</th>
			</tr>
	<?php
		$ticket = $postManager->getAllTickets();
		if ($_GET['page'] == 1) {
			$start = 0;
			$end = 20;
		} 
		elseif ($_GET['page'] > 1) {
			$start = $_GET['page']*20 - 20;
			$end = $_GET['page']*20;
		}

		for ($i=$start; $i < $end ; $i++) { 
		 
		 if (isset($ticket[$i])) {
		 			
		 		
		/*
		foreach ($episode as $key => $value) {
		*/
		?>
			<tr>
				<td><?= mb_strimwidth($ticket[$i]->getTitle(), 0, 45, '...') ?></td> 
				<td><?= mb_strimwidth($ticket[$i]->getCreationDate(), 10, 18) ?></td>
				<td><a href="index.php?action=allTickets&amp;see=<?= $ticket[$i]->getPostId() ?>&amp;page=<?= $_GET['page'] ?>" title="Voir"><i class="fas fa-plus-circle"></i></a>
				<a href="index.php?action=allTickets&amp;edit=<?= $ticket[$i]->getPostId() ?>&amp;type=ticket&amp;page=<?= $_GET['page'] ?>" title="Modifier"><i class="far fa-edit"></i></a>
				<a href="index.php?action=moderate&amp;delete=<?= $ticket[$i]->getPostId() ?>&amp;from=allTickets&amp;page=<?= $_GET['page'] ?>" title="Supprimer"><i class="far fa-trash-alt"></i></a></td>
			</tr>
		<?php
		}
	}
	?>
		</table>

		<p id="pagination">Allez à la page :     
<?php
$pagesNumber = $postManager->paging('ticket');

for ($j=0; $j < $pagesNumber; $j++) {
?>
    <a href="index.php?action=allTickets&page=<?= $j+1 ?>"><?= $j+1 ?></a>
<?php 
}
?>
</p>
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