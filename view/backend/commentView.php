<?php
	$commentManager = new JeanForteroche\Blog\Model\CommentManager();
	$comment = $commentManager->getComment($_GET['see']);
	$postId = $comment->getPostId();
	$postManager = new JeanForteroche\Blog\Model\PostManager();
	$post = $postManager->getPost($postId);

	if ($post->getType() == 'episode') {
		$type = '<i class="fab fa-envira"></i>';
	} elseif ($post->getType() == 'ticket') {
		$type = '<i class="fas fa-bullhorn"></i>';
	}

?>
<div class="col-lg-4 col-lg-push-1 second-panel second-panel-back">

	<h2 class="second-panel-title">CONTENU DU COMMENTAIRE <i class="fas fa-comments"></i></h2>
	<div class="chains-nails-contener">
    	<div>
			<img src="public/images/chain1.png" class="back-second-panel-left-chain"> 	
			<img src="public/images/chain1.png" class="back-second-panel-right-chain">
			<img src="public/images/nail1.png" class="back-second-panel-left-nail-article">
			<img src="public/images/nail1.png" class="back-second-panel-right-nail-article">
		</div>
	</div>
	<div class="second-panel-comment">
		<h2 class="second-panel-comment-author" ><?= $comment->getAuthor() ?></h2>
		<p class="second-panel-comment-date"><?= mb_strimwidth($comment->getCommentDate(), 0, 22) ?></p>
		<div class="second-panel-comment-content">
			<p><?= $comment->getComment() ?></p>
		</div>
		<p class="second-panel-comment-relatedPost"><i class="fas fa-long-arrow-alt-right"> </i>
<?= $post->getTitle() . ' ' . $type ?> </p>
	</div>
</div>