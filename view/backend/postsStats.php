<?php 

$episodeStats = $postManager->getAllEpisodes();
$ticketStats = $postManager->getAllTickets();

$mostCommentedEpisode = $commentManager->getMostCommentedArticle('episode');
$mostCommentedTicket = $commentManager->getMostCommentedArticle('ticket');
$episode = $postManager->getPost($mostCommentedEpisode);
$ticket = $postManager->getPost($mostCommentedTicket);

$mostReadEpisode = $counterManager->mostReadArticle('episode');
$mostReadTicket = $counterManager->mostReadArticle('ticket');
$episodeN1 = $postManager->getPost($mostReadEpisode);
$ticketN1 = $postManager->getPost($mostReadTicket);

?>        

<div>
	<h2 class="stats-h2"><i class="fas fa-paperclip"></i> LES PUBLICATIONS</h2>

	<ul class="articlesStatsBlock">
		<li><i class="fas fa-arrow-circle-right"></i> <?= count($episodeStats) ?> épisodes </li>
		<li><i class="fas fa-arrow-circle-right"></i> <?= count($ticketStats) ?> billets </li>
	</ul>
	
	<h2 class="stats-h2"><i class="far fa-bell"></i> LES PLUS COMMENTÉS</h2>
	<ul class="articlesStatsBlock">
			<li><i class="fas fa-arrow-circle-right"></i> <?= strtolower($episode->getTitle()) ?> </li>
			<li><i class="fas fa-arrow-circle-right"></i> <?= strtolower($ticket->getTitle()) ?> </li>
	</ul>

	<h2 class="stats-h2"><i class="fas fa-users"></i> LES PLUS LUS</h2>

	<ul  class="articlesStatsBlock">
		<li><i class="fas fa-arrow-circle-right"></i> <?= strtolower($episodeN1->getTitle()) ?> </li>
		<li><i class="fas fa-arrow-circle-right"></i> <?= strtolower($ticketN1->getTitle()) ?> </li>
	</ul>
</div>

