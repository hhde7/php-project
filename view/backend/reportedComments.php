<?php 
	$reportedComments = $commentManager->getAllReportedComments();
	
	for ($i=0; $i < count($reportedComments) ; $i++) {
        $postId = $reportedComments[$i]->getPostId();
        $postTitle = $postManager->getPost($postId)->getTitle();

        if ($reportedComments[$i]->getPostType() === 'ticket') {
            $postType = 'Billet : ';
        } 
        else {
            $postType = 'Épisode : ';
        }
        
        ?>
        	<p><?= $postType . ' ' . $postTitle ?></p>
        	<p><strong><?= $reportedComments[$i]->getAuthor() ?></strong><em><?= $reportedComments[$i]->getCommentDate() ?></em></p>
            <p><?= $reportedComments[$i]->getComment() ?></p>
            <a href="index.php?action=dashboard&amp;delete=<?=$reportedComments[$i]->getCommentId() ?>">Supprimer</a> <a href="index.php?action=dashboard&amp;allow=<?=$reportedComments[$i]->getCommentId() ?>">Accepter</a>
            <p>--------------------</p>
        
        <?php     
    } 
