<header>

	<div id="header" class="col-lg-12">
		<a href="index.php"><img id="logo" src="public/images/logo-1.png"/></a>
	</div>
<?php
if (!isset($_SESSION['email']) AND !isset($_SESSION['password']) ) {
?>
	<a id="login-logout" href="index.php?action=login">Se connecter</a>
<?php
}
else
{
?>	
	<a id="login-logout" href="index.php?action=logout">Se déconnecter</a>
<?php
}
?>
</header>