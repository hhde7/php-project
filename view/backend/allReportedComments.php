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
		include "view/frontend/header.php";
		include "view/backend/lateralBar.php";
		?>
		<div class="hidden-lg hidden-md hidden-sm col-xs-12 mobile-menu">
			<?php
			include "view/backend/mobileMenu.php";
			?>
		</div>

		<div class="col-lg-4 col-lg-pull-0 col-md-4 col-md-pull-0 col-sm-8 col-sm-pull-1 col-xs-12 col-xs-pull-0 first-panel first-panel-back"> 	

			<h2 class="first-panel-title">COMMENTAIRES SIGNALÉS <i class="fas fa-comments"></i></h2>
			
			<div class="chains-nails-contener">
	    		<div>
					<img src="public/images/chain2.png" class="back-first-panel-left-chain"> 	
					<img src="public/images/chain2.png" class="back-first-panel-right-chain">
					<img src="public/images/nail1.png" class="back-first-panel-left-nail-comment">
					<img src="public/images/nail1.png" class="back-first-panel-right-nail-comment">
				</div>
			</div>
			<table class="table table-striped">
				<tr>
					<th>AUTEUR</th>	
					<th>DATE DE PUBLICATION</th>
					<th>ACTION</th>
				</tr>
				
				<?php
				// DÉCOUPAGE DE LA LISTE DES COMMENTAIRES EN LOTS DE 20 ÉLÉMENTS MAXIMUM
				if ($_GET['page'] == 1) {
					$start = 0;
					$end = 20;
				} elseif ($_GET['page'] > 1) {
					$start = $_GET['page']*20 - 20;
					$end = $_GET['page']*20;
				}
				// BOUCLE AFFICHANT LES COMMENTAIRES EXISTANTS POUR CHAQUE PAGE
				for ($i=$start; $i < $end ; $i++) { 
			 		
					if (isset($reportedComments[$i])) { // EVITE UNE ERREUR SI LES 20 ÉLÉMENTS NE SONT PAS TROUVÉS
						?>
						<tr>
							<td class="table-title"><?= $reportedComments[$i]->getAuthor() ?></td> 
							<td class="table-comment"><?= mb_strimwidth($reportedComments[$i]->getComment(), 0, 35, '...') ?></td>
							<td class="table-options">
								<a href="index.php?action=reportedComments&amp;see=<?= $reportedComments[$i]->getCommentId() ?>&amp;page=<?= $_GET['page'] ?>" title="Voir"><i class="fas fa-plus-circle"></i></a>
								<a href="index.php?action=moderate&amp;allow=<?= $reportedComments[$i]->getCommentId() ?>&amp;from=reportedComments&amp;page=<?= $_GET['page'] ?>" title="Accepter"><i class="fas fa-check-circle"></i></a>
								<a href="index.php?action=moderate&amp;delete=<?= $reportedComments[$i]->getCommentId() ?>&amp;from=reportedComments&amp;page=<?= $_GET['page'] ?>" title="Supprimer"><i class="fas fa-minus-circle"></i></a>
							</td>
						</tr>
					<?php
					}
				}
			?>
			</table>

			<p id="pagination">Allez à la page :     
			<?php
			// PAGINATION
			for ($j=0; $j < $pagesNumber; $j++) {
				?>
	    		<a href="index.php?action=reportedComments&page=<?= $j+1 ?>"><?= $j+1 ?></a>
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