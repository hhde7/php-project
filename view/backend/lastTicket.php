<?php 
    $lastTicket = $postManager->getLastTicket();
    
        ?>
            <p><strong><?= $lastTicket->getTitle() ?></strong></p>
            <p><?= $lastTicket->getContent() ?></p>