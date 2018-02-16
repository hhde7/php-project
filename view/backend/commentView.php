<div class="col-lg-4 col-lg-push-1 second-panel">
<?php
	$commentManager = new JeanForteroche\Blog\Model\CommentManager();
	$comment = $commentManager->getComment($_GET['see']);
	echo $comment->getAuthor() . '<br />';
	echo $comment->getCommentDate() . '<br />';
	echo $comment->getComment() . '<br />';
?>
</div>