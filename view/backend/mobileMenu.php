<?php
if ($_GET['action'] == 'dashboard') {
?>
	<div >
		<a class="col-xs-12" href="index.php">Revenir à la page d'accueil</a>
	</div>
<?php
} 
else
{
?>
	<div >
		<a class="col-xs-12" href="index.php?action=dashboard">Revenir au tableau de bord</a>
	</div>
<?php
}
