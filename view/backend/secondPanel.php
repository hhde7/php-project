<?php 
	$reportedComments = $commentManager->getAllReportedComments();
?>
<h2 class="first-panel-title">COMMENTAIRES SIGNALÉS <i class="fas fa-comments"></i></h2>
        <img src="public/images/chain1.png" class="left-chain">     
        <img src="public/images/chain1.png" class="right-chain">
        <img src="public/images/nail1.png" class="left-nail">
        <img src="public/images/nail1.png" class="right-nail">


<?php
	
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
        
            <div class="second-panel-comment-box">
            	<p><?= $postType . ' ' . $postTitle ?></p>
            	<p><strong><?= $reportedComments[$i]->getAuthor() ?></strong><em><?= $reportedComments[$i]->getCommentDate() ?></em></p>
                <p><?= $reportedComments[$i]->getComment() ?></p>
                <a href="index.php?action=moderate&amp;allow=<?=$reportedComments[$i]->getCommentId() ?>&amp;from=dashboard">Accepter</a> 
                <a href="index.php?action=moderate&amp;delete=<?=$reportedComments[$i]->getCommentId() ?>&amp;from=dashboard">Supprimer</a> 
            </div>
        
        <?php     
    }
    ?> 
<h2 class="first-panel-title">COMMENTAIRES RÉCENTS <i class="fas fa-comments"></i></h2>

        <img src="public/images/nail1.png" class="second-level-left-nail">
        <img src="public/images/nail1.png" class="second-level-right-nail">
    <div class="second-level-comment-contener">    
<?php
$limit = 10;
$lastComments = $commentManager->getLastComments();

for ($i=0; $i < count($lastComments) ; $i++) {
    $postId = $lastComments[$i]->getPostId();
    $postTitle = $postManager->getPost($postId)->getTitle();

    if ($lastComments[$i]->getPostType() === 'ticket') {
        $postType = '<i class="fas fa-bullhorn"></i>  ';
    }
    else {
        $postType = '<i class="fab fa-envira"></i>  ';
    }
?>

        <div class="second-panel-comment-box">
            <p><?= $postType . ' ' . $postTitle ?></p>
            <p><?= $lastComments[$i]->getAuthor() . $lastComments[$i]->getCommentDate()  ?></p>
            <p><?= $lastComments[$i]->getComment() ?></p>
        </div>
<?php
    }
?>
    </div>

