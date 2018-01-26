<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style_blog.css">
	<title>log</title>
</head>
<body>
	<?php
		if (isset($_POST['pseudo']) AND htmlspecialchars($_POST['pseudo']) == "JamesundJe55" AND isset($_POST['password']) AND htmlspecialchars($_POST['password']) == "j34nnoTgOtAgIRl") {
			header ('location: dashboard.php');
		} else {
		
			header ('location: login_jfroche.php?login=false');
			
		}
	?>

</body>
</html>