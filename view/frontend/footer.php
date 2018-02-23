<footer class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
	<?php
if (!isset($_SESSION['email']) AND !isset($_SESSION['password']) ) {
?>	
	<div class="login-logout">
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
</footer>