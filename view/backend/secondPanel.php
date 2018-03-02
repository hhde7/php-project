<h2 class="second-panel-title">COMMENTAIRES SIGNALÉS <i class="fas fa-comments"></i></h2>
<div class="chains-nails-contener">
    <div>
        <img src="public/images/chain2.png" alt="" class="back-second-panel-left-chain">
        <img src="public/images/chain2.png" alt="" class="back-second-panel-right-chain">
    </div>
    <div>
        <img src="public/images/nail1.png" alt="" class="back-second-panel-left-nail">
        <img src="public/images/nail1.png" alt="" class="back-second-panel-right-nail">
    </div>
</div>

<div class="second-panel-reported-comments">
    <?php
    if (isset($lastTwoReportedComments[0])) {
        // AFFICHE LES 2 DERNIERS COMMENTAIRES SIGNALÉS
        for ($i=0; $i < count($lastTwoReportedComments); $i++) {
            $postId = $lastTwoReportedComments[$i]->getPostId();
            $postTitle = $postManager->getPost($postId)->getTitle();
            if ($lastTwoReportedComments[$i]->getPostType() === 'ticket') {
                $postType = '<i class="fas fa-bullhorn"></i>  ';
            } else {
                $postType = '<i class="fab fa-envira"></i>  ';
            } ?>
            <div class="second-panel-comment-box">
               	<p><?= $postType . ' ' . $postTitle ?></p>
               	<p><strong><?= $lastTwoReportedComments[$i]->getAuthor() ?></strong><em><?= $lastTwoReportedComments[$i]->getCommentDate() ?></em></p>
                <p><?= $lastTwoReportedComments[$i]->getComment() ?></p>
                <a href="index.php?action=moderate&amp;allow=<?=$lastTwoReportedComments[$i]->getCommentId() ?>&amp;from=dashboard">Accepter</a>
                <a href="index.php?action=moderate&amp;delete=<?=$lastTwoReportedComments[$i]->getCommentId() ?>&amp;from=dashboard">Supprimer</a>
            </div>
            <?php
        } ?>
            <a href="index.php?action=reportedComments&page=1">Tout voir</a>
    <?php
    } else {
        ?>
        <p>Pas de commentaires signalés :) </p>
    <?php
    }
    ?>
</div>

<h2 class="second-panel-title">COMMENTAIRES RÉCENTS <i class="fas fa-comments"></i></h2>
<div class="chains-nails-contener">
    <div>
        <img src="public/images/nail1.png" alt="" class="back-second-panel-second-level-left-nail">
        <img src="public/images/nail1.png" alt="" class="back-second-panel-second-level-right-nail">
    </div>
</div>

<div class="second-level-comment-contener">
    <?php
    if (isset($lastFiveComments[0])) {
        // AFFICHE LES 5 DERNIERS COMMENTAIRES PUBLIÉS
        for ($i=0; $i < count($lastFiveComments) ; $i++) {
            $postId = $lastFiveComments[$i]->getPostId();
            $postTitle = $postManager->getPost($postId)->getTitle();

            if ($lastFiveComments[$i]->getPostType() === 'ticket') {
                $postType = '<i class="fas fa-bullhorn"></i>  ';
            } else {
                $postType = '<i class="fab fa-envira"></i>  ';
            } ?>
            <div class="second-panel-comment-box">
                <p><?= $postType . ' ' . $postTitle ?></p>
                <p><?= $lastFiveComments[$i]->getAuthor() . $lastFiveComments[$i]->getCommentDate()  ?></p>
                <p><?= $lastFiveComments[$i]->getComment() ?></p>
            </div>
        <?php
        } ?>
            <a href="index.php?action=allComments&page=1">Tout voir</a>
    <?php
    } else {
        ?>
        <p>Pas encore de commentaires :( </p>
    <?php
    }
    ?>
</div>
