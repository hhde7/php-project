<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style_blog.css">
	<title>Login</title>
</head>
<body>
	<div id="box">
		<form method="post" action="log_validation.php">
			<label>Pseudo<input type="text" name="pseudo" required ></label><br />
			<label>Mot de passe<input type="password" name="password" required></label>
			<input id="login-submit" type="submit" value="Valider" >
		</form>

		<?php 
			if (isset($_GET['login']) AND $_GET['login'] == 'false') {
				?>
				<br />
				<em>Mauvaise saisie ... :(</em>
				<?php
			}
		?>

	</div>

</body>
</html>