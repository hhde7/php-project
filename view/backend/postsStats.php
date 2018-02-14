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

<p><i class="fab fa-envira"></i> <?= count($episodeStats) ?> épisodes publiés</p>
<p><i class="fab fa-envira"></i> <?= $episode->getTitle() ?> est l'épisode le plus commenté</p>
<p><i class="fab fa-envira"></i> <?= $episodeN1->getTitle() ?> est l'épisode le plus lu</p>
<p><i class="fas fa-bullhorn"></i> <?= count($ticketStats) ?> billets publiés </p>

<p><i class="fas fa-bullhorn"></i> <?= $ticket->getTitle() ?> est le billet plus commenté</p>

<p><i class="fas fa-bullhorn"></i> <?= $ticketN1->getTitle() ?>  est le billet le plus lu</p>

