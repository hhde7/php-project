
<h2 class="first-panel-title">BILLETS D'HUMEUR <i class="fas fa-bullhorn"></i></i></i></h2>

<img src="public/images/chain1.png" class="left-chain"> 	
<img src="public/images/chain1.png" class="right-chain">
<img src="public/images/nail1.png" class="left-nail">
<img src="public/images/nail1.png" class="right-nail">

<div class="first-panel-post">
	<p class="first-panel-post-title"><?= $ticket->getTitle() ?></p>
	<p class="first-panel-post-date"><?= $ticket->getCreationDate() ?></p>
	<p class="first-panel-post-content"><?= $ticket->getContent() ?></p>

</div>	  
	<div id="navControl">

		<?= $previousTicketLink ?>
		<?= $nextTicketLink ?>
		

	</div>

<?php 
 $comment = $commentManager->getAllComments($ticket->getPostId());
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
<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>