<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="public/css/style.css">
	<title>Login</title>
</head>
<body>
	<div id="box">
		<form method="post" action="index.php?action=loginCheck">
			<label>Adresse mail : <input type="email" name="email" required ></label><br />
			
			<label>Mot de passe : <input type="password" name="password" required></label>
			<input id="login-submit" type="submit" value="Valider" >
		</form>
		<p>**Mot de passe oublié</p>
		<p>**Retour au blog</p>		
	</div>
</body>
</html>