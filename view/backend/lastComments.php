<?php
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
        <p><?= $postType . ' ' . $postTitle ?></p>
        <p><?= $lastComments[$i]->getAuthor() . $lastComments[$i]->getCommentDate()  ?></p>
        <p><?= $lastComments[$i]->getComment() ?></p>
        <p>--------------------</p>
<?php
    }
?>



	
