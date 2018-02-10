       <div id="">
       <h4>Modérer un commentaire inapproprié</h4>
        
<?php
		if (isset($_GET['allow']) AND $_GET['allow'] > 0) {
		?>	
		<p>Souhaitez-vous vraiment accepter ce commentaire ?</p>
			<a href="index.php?action=moderate&amp;allow=<?=$_GET['allow']?>&amp;confirm=allow"><input type="button" value="Oui" /></a>
			<a href="index.php?action=dashboard"><input type="button" value="Non" /></a>
		<?php
		} elseif (isset($_GET['delete']) AND $_GET['delete'] > 0) {
		?>
		<p>Souhaitez-vous vraiment supprimer ce commentaire ?</p>
			<a href="index.php?action=moderate&amp;delete=<?=$_GET['delete']?>&amp;confirm=delete"><input type="button" value="Oui" /></a>
			<a href="index.php?action=dashboard"><input type="button" value="Non" /></a>
		<?php	
		} else {
		?>
			<p>bug</p>	
		<?php
		}
		
		?>