<h2 class="first-panel-title">ÉPISODE <?= mb_strimwidth($episode_->getTitle(),0,2) ?> <i class="fab fa-envira"></i></i></i></h2>

<img src="public/images/chain1.png" class="left-chain"> 	
<img src="public/images/chain1.png" class="right-chain">
<img src="public/images/nail1.png" class="left-nail">
<img src="public/images/nail1.png" class="right-nail">

<div class="first-panel-post">

	<p class="first-panel-post-title episode-number"><?= mb_strimwidth($episode_->getTitle(),0,2) ?></p>
	<p class="first-panel-post-title"><?= mb_strimwidth($episode_->getTitle(),2,100) ?></p>
	<p class="first-panel-post-date"><?= $episode_->getCreationDate() ?></p>
	<p class="first-panel-post-content"><?= $episode_->getContent() ?></p>
</div>

<div id="navControl">
	<?= $previousEpisodeLink ?>
	<?= $nextEpisodeLink ?>
</div>

   
<?php

$comment = $commentManager->getAllComments($episode_->getPostId());
?>
<h2 class="first-panel-title">COMMENTAIRES <i class="fa fa-comments"></i></i></i></h2>

<img src="public/images/nail1.png" class="second-level-left-nail">
<img src="public/images/nail1.png" class="second-level-right-nail">

<div class="second-level-first-panel-post">
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
