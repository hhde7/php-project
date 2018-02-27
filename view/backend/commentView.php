<div class="col-lg-4 col-lg-push-1 col-md-4 col-md-push-1 col-sm-8 col-sm-pull-1 col-xs-12 second-panel second-panel-back second-panel-second-level-back" id="post-link">
	<h2 class="second-panel-title">CONTENU DU COMMENTAIRE <i class="fas fa-comments"></i></h2>
	<div class="chains-nails-contener">
    	<div>
			<img src="public/images/chain2.png" alt="" class="back-second-panel-left-chain"> 	
			<img src="public/images/chain2.png" alt="" class="back-second-panel-right-chain">
			<img src="public/images/nail1.png" alt="" class="back-second-panel-left-nail-article">
			<img src="public/images/nail1.png" alt="" class="back-second-panel-right-nail-article">
		</div>
	</div>
	<div class="second-panel-comment">
		<h2 class="second-panel-comment-author" ><?= $comment->getAuthor() ?></h2>
		<p class="second-panel-comment-date"><?= mb_strimwidth($comment->getCommentDate(), 0, 22) ?></p>
		<div class="second-panel-comment-content">
			<p><?= $comment->getComment() ?></p>
		</div>
		<p class="second-panel-comment-relatedPost"><i class="fas fa-long-arrow-alt-right"> </i> <?= $post->getTitle() . ' ' . $type ?> </p>
	</div>
</div>
