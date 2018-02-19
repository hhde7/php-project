<?php 
 $comment = $commentManager->getAllComments($lastEpisode->getPostId());
?>
<h2 class="first-panel-title">COMMENTAIRES <i class="fa fa-comments"></i></i></i></h2>

<img src="public/images/chain1.png" class="left-chain"> 	
<img src="public/images/chain1.png" class="right-chain">
<img src="public/images/nail1.png" class="left-nail">
<img src="public/images/nail1.png" class="right-nail">

<div class="first-panel-post">
	<?php
	foreach ($comment as $key => $value) {
		?>
		<p class="first-panel-post-title"><?= $value->getAuthor() ?></p>
		<p class="first-panel-post-date"><?= $value->getCommentDate() ?></p>
		<p class="first-panel-post-content"><?= $value->getComment() ?></p>
		<?php
	}
	?>
</div>	  