<?php
if(isset($_GET['type'])) {
	if ($_GET['type'] == 'episode') {
		$type = 'épisode';
		$href = 'index.php?action=allEpisodes&amp;page=' . $_GET['page'];
	}
	elseif ($_GET['type'] == 'ticket') {
		$type = 'billet';
		$href = 'index.php?action=allTickets' . $_GET['page'];
	}
	elseif ($_GET['action'] == 'allComments' AND $_GET['type'] == 'comment') {
		$type = 'commentaire';
		$href = 'index.php?action=allComments' . $_GET['page'];
	}
	elseif ($_GET['action'] == 'reportedComments' AND $_GET['type'] == 'comment') {
		$type = 'commentaire';
		$href = 'index.php?action=reportedComments&page=' . $_GET['page'];
	}
}
?>
<div class="centered-box">
	<h2>Supprimer un <?= $type ?></h2>

			
	<?php
	if (isset($_GET['type'])) {
	?>	
		<p>Souhaitez-vous vraiment supprimer cette entrée ?</p>
		<a href="<?= $href?>&amp;delete=<?= $_GET['delete'] ?>&amp;done=yes"><input type="button" value="Oui" id='deleteButton'/></a>
		<a href="<?= $href ?>"><input type="button" value="Non" /></a>
	<?php
	}
	?>
</div>
<script type="text/javascript" src="http://localhost/test/jeanforteroche/scripts/refresh.js"></script>