<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="public/css/style.css">
		<link rel="icon" type="image/png" href="http://lafondationphoenix.com/JeanForteroche/public/images/favicon.png" />
		<title>Login</title>
	</head>
	<body>
		<div class="centered-box">
			<form method="post" action="index.php?action=loginCheck">
				<label><strong>Mail</strong></label><br />
				<input type="email" name="email" required /><br />
				<label><strong>Mdp</strong></label><br />
				<input type="password" name="password" required /><br />
				<input id="login-submit" type="submit" value="Valider" >
			</form>
			<p><a href="index.php">Retour au blog</a></p>
		</div>
	</body>
</html>
