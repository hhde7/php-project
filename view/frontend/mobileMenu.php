<?php
if (!isset($_GET['action'])) {
    ?>
	<div >
		<a class="col-xs-5" href="index.php?action=mobileTickets&amp;ticket=<?= $ticket->getPostId() ?>&amp;episode=<?= $episode->getPostId() ?>">Actualités</a>
		<p class="col-xs-2"> | </p>
		<a class="col-xs-5" href="index.php?action=mobileList">Liste des épisodes</a>
	</div>
<?php
} elseif (isset($_GET['action']) and $_GET['action'] == 'mobileTickets') {
        ?>
	<div>
		<a class="col-xs-5" href="index.php?ticket=<?= $lastTicket->getPostId() ?>&amp;episode=<?= $lastEpisode->getPostId() ?>">Épisodes</a>
		<p class="col-xs-2"> | </p>
		<a class="col-xs-5" href="index.php?action=mobileList">Liste des épisodes</a>
	</div>
<?php
    } elseif (isset($_GET['action']) and $_GET['action'] == 'mobileList') {
        ?>
	<div>
		<a class="col-xs-5" href="index.php?action=mobileTickets&amp;ticket=<?= $lastTicket->getPostId() ?>&amp;episode=<?= $lastEpisode->getPostId() ?>">Actualités</a>
		<p class="col-xs-2"> | </p>
		<a class="col-xs-5" href="index.php?ticket=<?= $lastTicket->getPostId() ?>&amp;episode=<?= $lastEpisode->getPostId() ?>">Dernier Épisode</a>
	</div>
<?php
    }
