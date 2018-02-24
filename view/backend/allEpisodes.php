<?php
	require_once('model/PostManager.php');
	$PostManager = new  JeanForteroche\Blog\Model\PostManager();
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="public/css/style.css">
		<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
		
		<link href="public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<title>Tous les épisodes</title>
</head>
<body>
	<?php
		include('view/frontend/header.php');
		include('view/backend/lateralBar.php');
	?>

	<div class="hidden-lg hidden-md hidden-sm col-xs-12 mobile-menu">
		<?php
		include('view/backend/mobileMenu.php');
		?>
	</div>

	<div class="col-lg-4 col-lg-pull-0 col-md-4 col-md-pull-0 col-sm-8 col-sm-pull-1 col-xs-12 col-xs-pull-0 first-panel first-panel-back">

		<h2 class="first-panel-title">TOUS LES ÉPISODES <i class="fab fa-envira"></i></h2>
		<div class="chains-nails-contener">
    		<div>
				<img src="public/images/chain2.png" class="back-first-panel-left-chain"> 	
				<img src="public/images/chain2.png" class="back-first-panel-right-chain">
				<img src="public/images/nail1.png" class="back-first-panel-left-nail-episode">
				<img src="public/images/nail1.png" class="back-first-panel-right-nail-episode">
			</div>
		</div>

		<table class="table table-striped">
			<tr>
				<th>TITRE</th>		
				<th>DATE DE PUBLICATION</th>
				<th>ACTION</th>
			</tr>


	<?php
		$episode = $PostManager->getAllEpisodes();
		if ($_GET['page'] == 1) {
			$start = 0;
			$end = 20;
		} 
		elseif ($_GET['page'] > 1) {
			$start = $_GET['page']*20 - 20;
			$end = $_GET['page']*20;
		}

		for ($i=$start; $i < $end ; $i++) { 
		 
		 if (isset($episode[$i])) {
		 			
		 		
		/*
		foreach ($episode as $key => $value) {
		*/
		?>
			<tr>
				<td class="table-title"><?= mb_strimwidth($episode[$i]->getTitle(), 0, 45, '...') ?></td> 
				<td class="table-date"><?= mb_strimwidth($episode[$i]->getCreationDate(), 10, 18) ?></td>
				<td class="table-options"><a href="index.php?action=allEpisodes&amp;see=<?= $episode[$i]->getPostId() ?>&amp;page=<?= $_GET['page'] ?>" title="Voir"><i class="fas fa-plus-circle"></i></a>
				<a href="index.php?action=allEpisodes&amp;edit=<?= $episode[$i]->getPostId() ?>&amp;type=episode&amp;page=<?= $_GET['page'] ?>" title="Modifier"><i class="far fa-edit"></i></a>
				<a href="index.php?action=moderate&amp;delete=<?= $episode[$i]->getPostId() ?>&amp;type=<?= $episode[$i]->getType()?>&amp;from=allEpisodes&amp;page=<?= $_GET['page'] ?>" title="Supprimer"><i class="far fa-trash-alt"></i></a></td>
			</tr>
		<?php
		 }		
		}
	?>
		</table>

<p id="pagination">Allez à la page :     
<?php
$pagesNumber = $postManager->paging('episode');

for ($j=0; $j < $pagesNumber; $j++) {
?>
    <a href="index.php?action=allEpisodes&page=<?= $j+1 ?>"><?= $j+1 ?></a>
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