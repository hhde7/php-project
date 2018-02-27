<!-- AFFICHAGE DE LA PARTIE SUPÉRIEURE DU PANNEAU 1: LES BILLETS ACTUALITÉS -->
<h2 class="first-panel-title">ACTUALITÉS <i class="fas fa-bullhorn"></i></h2>
<div class="chains-nails-contener">
    <div>
        <img src="public/images/chain2.png" alt="" class="front-first-panel-left-chain">
        <img src="public/images/chain2.png" alt="" class="front-first-panel-right-chain">
    </div>
    <div>
        <img src="public/images/nail1.png" alt="" class="front-first-panel-left-nail">
        <img src="public/images/nail1.png" alt="" class="front-first-panel-right-nail">
    </div>
</div>

<div class="first-panel-post">
	<p class="first-panel-post-title"><?= $ticket->getTitle() ?></p>
	<p class="first-panel-post-date"><?= $ticket->getCreationDate() ?></p>
	<div class="first-panel-post-content"><?= $ticket->getContent() ?></div>

</div>
<!-- LIENS DE NAVIGATION ENTRE LES BILLETS -->
<div class="nav-control">
	<?= $previousTicketLink ?>
	<?= $nextTicketLink ?>
</div>

<!-- AFFICHAGE DE LA PARTIE INFÉRIEURE DU PANNEAU 1: LES COMMENTAIRES DES BILLETS -->
<h2 class="first-panel-title">COMMENTAIRES <i class="fa fa-comments"></i></h2>
<div class="chains-nails-contener">
    <div>
        <img src="public/images/nail1.png" alt="" class="front-first-panel-second-level-left-nail">
        <img src="public/images/nail1.png" alt="" class="front-first-panel-second-level-right-nail">
    </div>
</div>
<div class="second-level-first-panel-post">
    <!-- BOUCLE RENVOYANT TOUS LES COMMENTAIRES LIÉS AU BILLET AFFICHÉ PRÉCÉDEMMENT -->
	<?php
	foreach ($ticketComments as $key => $value) {
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
            <a class="report-it" href="index.php?action=report&amp;comment=<?= $thisComment ?>&amp;id=<?= $_GET['ticket']?>&amp;ticket=<?= $_GET['ticket'] ?>&amp;episode=<?= $_GET['episode'] ?>">signaler un abus<br /></a>
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
if (isset($_GET['ticket']) AND $ticketCheck->getType() === 'ticket' AND $ticketCheck->getPostId() != Null) {
    ?>
    <form class="ticket-comment-form" action="index.php?action=addComment&amp;ticket=<?= $_GET['ticket'] ?>&amp;episode=<?= $_GET['episode'] ?>&amp;type=ticket&amp;post=<?= $_GET['ticket'] ?>" method="post" id="ticket-comment-form">
        <div>
            <label for="ticket-comment-author">Pseudo</label><br />
            <input type="text" id="ticket-comment-author" name="author" required/>
        </div>
        <div>
            <label for="ticket-comment">Commentaire</label><br />
            <textarea class="comment" id="ticket-comment" name="comment" maxlength="400" required></textarea>
        </div>
        <div>
            <input type="submit" class="submit" />
        </div>
    </form>
<?php
} else { // SI ABSENCE DE DONNÉES VIA L'URL
    ?>
	<div class="leave-comment">
		<a href="index.php?ticket=<?= $lastTicket->getPostId() ?>&amp;episode=<?= $lastEpisode->getPostId() ?>#ticket-comment-form">Laisser un commentaire</a>
	</div>
<?php
}
?>
