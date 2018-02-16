<div class="col-lg-4 col-lg-push-2 second-panel">

	<?php
	$postManager = new JeanForteroche\Blog\Model\PostManager();
	$post = $postManager->getPost($_GET['see']);
	echo $post->getTitle() . '<br />';
	echo $post->getCreationDate() . '<br />';
	echo $post->getContent() . '<br />';
	?>
</div>