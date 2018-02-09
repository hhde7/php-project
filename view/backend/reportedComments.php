<?php 
	$reportedComments = $commentManager->getAllReportedComments();
	
	for ($i=0; $i < count($reportedComments) ; $i++) {
        ?>
        	<p><strong>Article n° <?= $reportedComments[$i]->getPostId() ?></strong></p>
        	<p><strong><?= $reportedComments[$i]->getAuthor() ?></strong><em><?= $reportedComments[$i]->getCommentDate() ?></em></p>
            <p><?= $reportedComments[$i]->getComment() ?></p>
            <a href="index.php?action=dashboard&amp;delete=<?=$reportedComments[$i]->getCommentId() ?>">Supprimer</a> <a href="index.php?action=dashboard&amp;allow=<?=$reportedComments[$i]->getCommentId() ?>">Accepter</a>
        
        <?php     
    } 
