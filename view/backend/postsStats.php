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
	<h2><i class="fas fa-paperclip"></i> LES PUBLICATIONS</h2>

	<ul class="articlesStatsBlock">
		<li><a href="index.php?action=allEpisodes&amp;page=1" id="read">- <?= count($episodeStats) ?> épisodes </a></li>
		<li><a href="index.php?action=allTickets&amp;page=1">- <?= count($ticketStats) ?> billets </a></li>
	</ul>
	
	<h2><i class="far fa-bell"></i> LES PLUS COMMENTÉS</h2>
	<ul class="articlesStatsBlock">
			<li><a href="index.php?action=allEpisodes&see=<?= $episode->getPostId() ?>&amp;page=1">- <?= strtolower($episode->getTitle()) ?> </a></li>
			<li><a href="index.php?action=allTickets&see=<?= $ticket->getPostId() ?>&amp;page=1">- <?= strtolower($ticket->getTitle()) ?> </a></li>
	</ul>

	<h2><i class="fas fa-users"></i> LES PLUS LUS</h2>

	<ul  class="articlesStatsBlock">
		<li><a href="index.php?action=allEpisodes&see=<?= $episodeN1->getPostId() ?>&amp;page=1">- <?= strtolower($episodeN1->getTitle()) ?> </a></li>
		<li><a href="index.php?action=allTickets&see=<?= $ticketN1->getPostId() ?>&amp;page=1">- <?= strtolower($ticketN1->getTitle()) ?> </a></li>
	</ul>
</div>

