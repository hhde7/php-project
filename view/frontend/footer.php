<footer class='col-lg-12'>
	<?php
	if (!isset($_SESSION['email']) AND !isset($_SESSION['password']) ) {
	?>
		<a href="index.php?action=login">Se connecter</a>
	<?php
	}
	else
	{
	?>	
		<a href="index.php?action=logout">Se déconnecter</a>
	<?php
	}
	?>
</footer>