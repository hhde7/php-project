<div>
	<h2><i class="fas fa-paperclip"></i> LES PUBLICATIONS</h2>

	<ul class="articlesStatsBlock">
		<li><a href="index.php?action=allEpisodes&amp;page=1" id="read">-<strong> <?= count($episodeStats) ?></strong> épisodes </a></li>
		<li><a href="index.php?action=allTickets&amp;page=1">-<strong> <?= count($ticketStats) ?></strong> billets </a></li>
	</ul>
	
	<h2><i class="far fa-bell"></i> LES PLUS COMMENTÉS</h2>
	<ul class="articlesStatsBlock">
			<li><a href="index.php?action=allEpisodes&see=<?= $episode->getPostId() ?>&amp;page=1">- <strong><?= strtolower($episode->getTitle()) ?> </strong></a></li>
			<li><a href="index.php?action=allTickets&see=<?= $ticket->getPostId() ?>&amp;page=1">- <strong><?= strtolower($ticket->getTitle()) ?> </strong></a></li>
	</ul>

	<h2><i class="fas fa-users"></i> LES PLUS LUS</h2>

	<ul  class="articlesStatsBlock">
		<li><a href="index.php?action=allEpisodes&see=<?= $episodeN1->getPostId() ?>&amp;page=1">- <strong><?= strtolower($episodeN1->getTitle()) ?></strong> </a></li>
		<li><a href="index.php?action=allTickets&see=<?= $ticketN1->getPostId() ?>&amp;page=1">- <strong><?= strtolower($ticketN1->getTitle()) ?></strong> </a></li>
	</ul>
</div>

