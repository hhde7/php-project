<h2 class="first-panel-title">DERNIER ÉPISODE PUBLIÉ <i class="fab fa-envira"></i></i></i></h2>
<div class="chains-nails-contener">
	<div>
		<img src="public/images/chain2.png" alt="" class="back-first-panel-left-chain">
		<img src="public/images/chain2.png" alt="" class="back-first-panel-right-chain">
	</div>
	<div>
		<img src="public/images/nail1.png" alt="" class="back-first-panel-left-nail">
		<img src="public/images/nail1.png" alt="" class="back-first-panel-right-nail">
	</div>
</div>

<div class="first-panel-post">
	<p class="first-panel-post-title episode-number"><?= mb_strimwidth($lastEpisode->getTitle(), 0, 2) ?></p>
	<p class="first-panel-post-title"><?= mb_strimwidth($lastEpisode->getTitle(), 2, 100) ?></p>
	<p class="first-panel-post-date"><?= $lastEpisode->getCreationDate() ?></p>
	<div class="first-panel-post-content"><?= $lastEpisode->getContent() ?></div>
</div>

<h2 class="first-panel-title">DERNIER BILLET PUBLIÉ <i class="fas fa-bullhorn"></i></i></i></h2>
<div class="chains-nails-contener">
    <div>
		<img src="public/images/nail1.png" alt="" class="back-first-panel-second-level-left-nail">
		<img src="public/images/nail1.png" alt="" class="back-first-panel-second-level-right-nail">
	</div>
</div>

<div class="first-panel-second-level-post">
	<p class="first-panel-post-title"><?= $lastTicket->getTitle() ?></p>
	<p class="first-panel-post-date"><?= $lastTicket->getCreationDate() ?></p>
	<div class="first-panel-post-content"><?= $lastTicket->getContent() ?></div>
</div>
