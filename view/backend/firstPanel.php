<?php 
	$lastEpisode = $postManager->getLastEpisode();
?>
<h2 class="first-panel-title">DERNIER ÉPISODE PUBLIÉ <i class="fab fa-envira"></i></i></i></h2>

<img src="public/images/chain1.png" class="left-chain"> 	
<img src="public/images/chain1.png" class="right-chain">
<img src="public/images/nail1.png" class="left-nail">
<img src="public/images/nail1.png" class="right-nail">

<div class="first-panel-post">
	<p class="first-panel-post-title episode-number"><?= mb_strimwidth($lastEpisode->getTitle(),0,2) ?></p>
	<p class="first-panel-post-title"><?= mb_strimwidth($lastEpisode->getTitle(),2,100) ?></p>
	<p class="first-panel-post-date"><?= $lastEpisode->getCreationDate() ?></p>
	<p class="first-panel-post-content"><?= $lastEpisode->getContent() ?></p>
</div>

<?php 
 $lastTicket = $postManager->getLastTicket();
?>
<h2 class="first-panel-title">DERNIER BILLET PUBLIÉ <i class="fas fa-bullhorn"></i></i></i></h2>

<img src="public/images/nail1.png" class="second-level-left-nail">
<img src="public/images/nail1.png" class="second-level-right-nail">

<div class="second-level-first-panel-post">
	<p class="first-panel-post-title"><?= $lastTicket->getTitle() ?></p>
	<p class="first-panel-post-date"><?= $lastTicket->getCreationDate() ?></p>
	<p class="first-panel-post-content"><?= $lastTicket->getContent() ?></p>
</div>	     
   
