<div class="col-lg-4 col-lg-push-1 col-md-4 col-md-push-1 col-sm-8 col-sm-pull-1 col-xs-12 second-panel second-panel-back second-panel-second-level-back" id="post-link">

	<h2 class="second-panel-title">CONTENU<?= $type ?></h2>
	<div class="chains-nails-contener">
    	<div>
			<img src="public/images/chain2.png" alt="" class="back-second-panel-left-chain">
			<img src="public/images/chain2.png" alt="" class="back-second-panel-right-chain">
			<img src="public/images/nail1.png" alt="" class="back-second-panel-left-nail-article">
			<img src="public/images/nail1.png" alt="" class="back-second-panel-right-nail-article">
		</div>
	</div>
	<div class="second-panel-post">
		<h2 class="second-panel-post-title" ><?= $post->getTitle() ?></h2>
		<p class="second-panel-post-date"><?= mb_strimwidth($post->getCreationDate(), 0, 28) ?></p>
		<div class="second-panel-post-content">
			<p><?= $post->getContent() ?></p>
		</div>
	</div>
</div>
