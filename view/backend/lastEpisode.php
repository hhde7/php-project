<?php 
	$lastEpisode = $postManager->getLastEpisode();
	
	    ?>
        	<p><i class="fab fa-envira"></i> <?= $lastEpisode->getTitle() ?></p>
        	<p><?= $lastEpisode->getContent() ?></p>
        
   
