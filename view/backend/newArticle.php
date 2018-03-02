<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
			<meta charset="utf-8">
			<link rel="stylesheet" type="text/css" href="public/css/style.css">
			<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
			<link rel="icon" type="image/png" href="http://lafondationphoenix.com/jeanforteroche/public/images/favicon.png" />

			<link href="public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<title>Rédaction d'un <?= $type ?></title>
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

			<h2 class="first-panel-title">RÉDIGER UN <?= $type ?></h2>
			<div class="chains-nails-contener">
	    		<div>
					<img src="public/images/chain2.png" alt="" class="back-first-panel-left-chain">
					<img src="public/images/chain2.png" alt="" class="back-first-panel-right-chain">
					<img src="public/images/nail1.png" alt="" class="back-first-panel-left-nail-new-article">
					<img src="public/images/nail1.png" alt="" class="back-first-panel-right-nail-new-article">
				</div>
			</div>

			<form action="index.php?action=<?= $_GET['action'] ?>&amp;posted=<?= $_GET['action'] ?>" method="post">
	            <div>
	                <label for="author">Titre</label><br />
	                <input type="text" class="title" name="title" maxlength="45" required/>
	            </div>
	            <div>
	                <label for="comment">Contenu</label><br />
	                <textarea class="tinymce" id="writer" name="content"></textarea>
	            </div>
	            <div>
	                <input type="submit" class="submit" />
	            </div>
	        </form>
		</div>

		<!-- JAVASCRIPT -->
		<!-- FONT AWESOME SCRIPT -->

		<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

		<!-- TINYMCE SCRIPTS -->
		<script type="text/javascript" src="http://localhost/test/jeanforteroche/plugins/tinymce/js/jquery.min.js"></script>
		<script type="text/javascript" src="http://localhost/test/jeanforteroche/plugins/tinymce/plugin/tinymce.min.js"></script>
		<script type="text/javascript" src="http://localhost/test/jeanforteroche/plugins/tinymce/plugin/init-tinymce.js"></script>


	</body>

	<?php
    include('view/frontend/footer.php');
    ?>

</html>
