<?php 
	$lastEpisode = $postManager->getLastEpisode();
	
	    ?>
        	<p><strong><?= $lastEpisode->getTitle() ?></strong></p>
        	<p><?= $lastEpisode->getContent() ?></p>
        
   
