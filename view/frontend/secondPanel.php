<!-- AFFICHAGE DE LA PARTIE SUPÉRIEURE DU PANNEAU 2: LES ÉPISODES -->
<h2 class="second-panel-title">BILLET SIMPLE POUR L'ALASKA - ÉPISODE <?= mb_strimwidth($episode_->getTitle(),0,2) ?> <i class="fab fa-envira"></i></h2>
<div class="chains-nails-contener">
    <div>
        <img src="public/images/chain2.png" alt="" class="front-second-panel-left-chain"> 	
        <img src="public/images/chain2.png" alt="" class="front-second-panel-right-chain">
        <img src="public/images/nail1.png" alt="" class="front-second-panel-left-nail">
        <img src="public/images/nail1.png" alt="" class="front-second-panel-right-nail">
    </div>
</div>
<div class="second-panel-post">

	<p class="first-panel-post-title episode-number"><?= mb_strimwidth($episode_->getTitle(),0,2) ?></p>
	<p class="first-panel-post-title"><?= mb_strimwidth($episode_->getTitle(),2,100) ?></p>
	<p class="first-panel-post-date"><?= $episode_->getCreationDate() ?></p>
	<div class="first-panel-post-content"><?= $episode_->getContent() ?></div>
</div>
<!-- LIENS DE NAVIGATION ENTRE LES ÉPISODES -->    
<div class="nav-control">
	<?= $previousEpisodeLink ?>
	<?= $nextEpisodeLink ?>
</div>

<!-- AFFICHAGE DE LA PARTIE INFÉRIEURE DU PANNEAU 2: LES COMMENTAIRES DES ÉPISODES -->
<h2 class="second-panel-title">COMMENTAIRES <i class="fa fa-comments"></i></h2>
<div class="chains-nails-contener">
    <div>
        <img src="public/images/nail1.png" alt="" class="front-second-panel-second-level-left-nail">
        <img src="public/images/nail1.png" alt="" class="front-second-panel-second-level-right-nail">
    </div>
</div>
<div class="second-level-first-panel-post">
    <!-- BOUCLE RENVOYANT TOUS LES COMMENTAIRES LIÉS A L'ÉPISODE AFFICHÉ PRÉCÉDEMMENT -->
	<?php
	foreach ($episodeComments as $key => $value) {
	?>
		<p><strong><?= $value->getAuthor() ?></strong><?= mb_strimwidth($value->getCommentDate(), 0, 22) ?></p>
		<p><?= $value->getComment() ?></p>
        
        <?php
        // LES DEUX PREMIÈRES CONDITIONS S'APPLIQUENT SI DES DONNÉES SONT TRANSMISENT VIA l'URL.
		if ($value->getReported() === '1' AND isset($_GET['ticket'])) {
              // AFFICHE QUE LE COMMENTAIRE EST EN ATTENTE DE MODÉRATION
            ?>
            <p class="reported">(message en attente de modération)<br /></p>
        <?php
        } elseif ($value->getReported() === '0' AND isset($_GET['ticket'])) {
            // AFFICHE LE LIEN VERS LE SIGNALEMENT DU COMMENTAIRE
            // SI CE DERNIER N'EST PAS DÉJÀ SIGNALÉ  
            $thisComment = $value->getCommentId();
            ?>
            <a class="report-it" href="index.php?action=report&amp;comment=<?= $thisComment ?>&amp;id=<?=$_GET['ticket']?>&amp;ticket=<?= $_GET['ticket'] ?>&amp;episode=<?= $_GET['episode'] ?>">signaler un abus<br /></a>
        <?php

        // LES CONDITIONS SUIVANTES S'APPLIQUENT SI AUCUNES DONNÉES NE SONT TRANSMISENT VIA l'URL.
    	} elseif ($value->getReported() === '1' AND !isset($_GET['ticket'])) {
    	    $thisComment = $value->getCommentId();
            ?>
            <p class="reported">(message en attente de modération)<br /></p>
        <?php
    	} elseif ($value->getReported() === '0' AND !isset($_GET['ticket'])) {
    	    $thisComment = $value->getCommentId();
            ?>
            <a class="report-it" href="index.php?action=report&amp;comment=<?= $thisComment ?>&amp;id=<?= $lastTicket->getPostId() ?>&amp;ticket=<?= $lastTicket->getPostId() ?>&amp;episode=<?= $lastEpisode->getPostId() ?>">signaler un abus<br /></a>
        <?php
    	}
    	?>
    	<br />
    <?php
	}
	?>
</div>	

<!-- CHARGE LE FORMULAIRE D'AJOUT DE COMMENTAIRES --> 
<?php
// SI PRÉSENCE DE DONNÉES VIA L'URL
if (isset($_GET['episode'])) {
    ?>
    <form class="episode-comment-form"  action="index.php?action=addComment&amp;ticket=<?= $_GET['ticket'] ?>&amp;episode=<?= $_GET['episode'] ?>&amp;type=episode&amp;post=<?= $_GET['episode'] ?>" method="post" id="episode-comment-form">
        <div>
            <label for="episode-comment-author">Pseudo</label><br />
            <input type="text" id="episode-comment-author" name="author" required/>
        </div>
        <div>
            <label for="episode-comment">Commentaire</label><br />
            <textarea class="comment" id="episode-comment" name="comment" required></textarea>
        </div>
        <div>
            <input type="submit" class="submit" />
        </div>
    </form>
<?php
} else {
    ?>
	<div class="leave-comment">
	   <a href="index.php?ticket=<?= $lastTicket->getPostId() ?>&amp;episode=<?= $lastEpisode->getPostId() ?>#episode-comment-form">Laisser un commentaire</a>
    </div>
<?php
}
?>