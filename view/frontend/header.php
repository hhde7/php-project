<header>

	<div class="col-lg-12">
		<a href="index.php"><img id="logo" src="public/images/logo-1.png"/></a>
	</div>
<?php
if (!isset($_SESSION['email']) AND !isset($_SESSION['password']) ) {
?>	
	<div class="login-logout">
		<a href="index.php?action=dashboard">Voir le tableau de bord</a> |
		<a href="index.php?action=login">Se connecter</a>
	</div>
<?php
}
else
{
?>	
	<div class="login-logout">
		<a href="index.php?action=dashboard">Voir le tableau de bord</a> |
		<a href="index.php?action=logout">Se déconnecter</a>
	</div>
<?php
}
?>
</header>