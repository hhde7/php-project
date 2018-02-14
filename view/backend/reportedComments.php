<?php 
	$reportedComments = $commentManager->getAllReportedComments();
	
	for ($i=0; $i < count($reportedComments) ; $i++) {
        $postId = $reportedComments[$i]->getPostId();
        $postTitle = $postManager->getPost($postId)->getTitle();

        if ($reportedComments[$i]->getPostType() === 'ticket') {
            $postType = '<i class="fas fa-bullhorn"></i>  ';
        } 
        else {
            $postType = '<i class="fab fa-envira"></i>  ';
        }
        
        ?>
        	<p><?= $postType . ' ' . $postTitle ?></p>
        	<p><strong><?= $reportedComments[$i]->getAuthor() ?></strong><em><?= $reportedComments[$i]->getCommentDate() ?></em></p>
            <p><?= $reportedComments[$i]->getComment() ?></p>
            <a href="index.php?action=moderate&amp;allow=<?=$reportedComments[$i]->getCommentId() ?>">Accepter</a>  <a href="index.php?action=moderate&amp;delete=<?=$reportedComments[$i]->getCommentId() ?>">Supprimer</a> 
            <p>--------------------</p>
        
        <?php     
    }
    ?> 
