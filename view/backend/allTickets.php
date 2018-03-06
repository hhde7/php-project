<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
			<meta charset="utf-8">
			<link rel="stylesheet" type="text/css" href="public/css/style.css">
			<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
			<link rel="icon" type="image/png" href="http://lafondationphoenix.com/JeanForteroche/public/images/favicon.png" />

			<link href="public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<title>Tous les billets</title>
	</head>
	<body>
		<?php
        include "View/frontend/header.php";
        include "View/backend/lateralBar.php";
        ?>
		<div class="hidden-lg hidden-md hidden-sm col-xs-12 mobile-menu">
			<?php
            include "View/backend/mobileMenu.php";
            ?>
		</div>

		<div class="col-lg-4 col-lg-pull-0 col-md-4 col-md-pull-0 col-sm-8 col-sm-pull-1 col-xs-12 col-xs-pull-0 first-panel first-panel-back">

			<h2 class="first-panel-title">TOUS LES BILLETS <i class="fas fa-bullhorn"></i></h2>

			<div class="chains-nails-contener">
	    		<div>
					<img src="public/images/chain2.png" alt="" class="back-first-panel-left-chain">
					<img src="public/images/chain2.png" alt="" class="back-first-panel-right-chain">
					<img src="public/images/nail1.png" alt="" class="back-first-panel-left-nail-ticket">
					<img src="public/images/nail1.png" alt="" class="back-first-panel-right-nail-ticket">
				</div>
			</div>
			<table class="table table-striped">
				<tr>
					<th class="col-lg-6">TITRE</th>
					<th class="col-lg-5">DATE DE PUBLICATION</th>
					<th class="col-lg-1">ACTION</th>
				</tr>

				<?php
                // DÉCOUPAGE DE LA LISTE DES BILLETS EN LOTS DE 20 ÉLÉMENTS MAXIMUM
                if ($_GET['page'] == 1) {
                    $start = 0;
                    $end = 20;
                } elseif ($_GET['page'] > 1) {
                    $start = htmlspecialchars($_GET['page'])*20 - 20;
                    $end = htmlspecialchars($_GET['page'])*20;
                } else {
                    die;
                }
                // BOUCLE AFFICHANT LES BILLETS EXISTANTS POUR CHAQUE PAGE
                for ($i=$start; $i < $end ; $i++) {
                    if (isset($tickets[$i])) {
                        ?>
						<tr>
							<td class="table-title"><?= mb_strimwidth($tickets[$i]->getTitle(), 0, 45, '...') ?></td>
							<td class="table-date"><?= mb_strimwidth($tickets[$i]->getCreationDate(), 10, 18) ?></td>
							<td class="table-options">
								<a href="index.php?action=allTickets&amp;see=<?= $tickets[$i]->getPostId() ?>&amp;page=<?= htmlspecialchars($_GET['page']) ?>" title="Voir"><i class="fas fa-plus-circle"></i></a>
								<a href="index.php?action=allTickets&amp;edit=<?= $tickets[$i]->getPostId() ?>&amp;type=ticket&amp;page=<?= htmlspecialchars($_GET['page']) ?>" title="Modifier"><i class="far fa-edit"></i></a>
								<a href="index.php?action=moderate&amp;delete=<?= $tickets[$i]->getPostId() ?>&amp;from=allTickets&amp;page=<?= htmlspecialchars($_GET['page']) ?>" title="Supprimer"><i class="far fa-trash-alt"></i></a>
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
			    <a class="pages-number" href="index.php?action=allEpisodes&page=<?= $j+1 ?>"><?= $j+1 ?></a>
			<?php
            }
            ?>
			</p>
			<p class="active-page">Page :
				<?php
                if (htmlspecialchars($_GET['page']) <= $pagesNumber) {
                    ?>
				<?= htmlspecialchars($_GET['page']) ?></p>
				<?php
                } else {
                    echo  'inconnue </p>' ;
                }
            ?>
		</div>

		<!-- JAVASCRIPT -->
		<script type="text/javascript" src="public/js/autoScroll.js"></script>
		<!-- FONT AWESOME SCRIPT -->

		<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

		<!-- TINYMCE SCRIPTS -->
		<script type="text/javascript" src="http://localhost/test/JeanForteroche/plugins/tinymce/js/jquery.min.js"></script>
		<script type="text/javascript" src="http://localhost/test/JeanForteroche/plugins/tinymce/plugin/tinymce.min.js"></script>
		<script type="text/javascript" src="http://localhost/test/JeanForteroche/plugins/tinymce/plugin/init-tinymce.js"></script>
	</body>
</html>
