<?php 
    $lastTicket = $postManager->getLastTicket();
    
        ?>
            <p><i class="fas fa-bullhorn"></i> <?= $lastTicket->getTitle() ?></p>
            <p><?= $lastTicket->getContent() ?></p>