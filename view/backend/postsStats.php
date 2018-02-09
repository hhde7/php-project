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

<p>Nombre d'épisodes publiés : <?= count($episodeStats) ?></p>
<p>Nombre de billets publiés : <?= count($ticketStats) ?></p>

<p>Épisode le plus commenté : <br /><?= $episode->getTitle() ?></p>
<p>Ticket le plus commenté : <br /><?= $ticket->getTitle() ?></p>

<p>Épisode le plus lu : <br /><?= $episodeN1->getTitle() ?></p>
<p>Ticket le plus lu : <br /><?= $ticketN1->getTitle() ?></p>

