<?php
$postManager = new JeanForteroche\Blog\Model\PostManager();
if (isset($_GET['see'])) {
	$post = $postManager->getPost($_GET['see']);
	$type = $post->getType();
} else {
	$post = $postManager->getPost($_GET['update']);
	$type = $post->getType();
}

if ($type == 'episode') {
	$type = ' DE L\' ÉPISODE <i class="fab fa-envira"></i>';
} elseif ($type == 'ticket') {
	$type = ' DU BILLET <i class="fas fa-bullhorn"></i>';
} 

?>
<div class="col-lg-4 col-lg-push-1 second-panel">

	<h2 class="first-panel-title">CONTENU<?= $type ?></h2>

		<img src="public/images/chain1.png" class="left-chain"> 	
		<img src="public/images/chain1.png" class="right-chain">
		<img src="public/images/nail1.png" class="left-nail">
		<img src="public/images/nail1.png" class="right-nail">

	<div class="second-panel-post">
		<h2 class="second-panel-post-title" ><?= $post->getTitle() ?></h2>
		<p class="second-panel-post-date"><?= mb_strimwidth($post->getCreationDate(), 0, 28) ?></p>
		<div class="second-panel-post-content">
			<p><?= $post->getContent() ?></p>
		</div>
	</div>
</div>