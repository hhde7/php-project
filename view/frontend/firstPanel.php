
<h2 class="first-panel-title">BILLETS D'HUMEUR <i class="fas fa-bullhorn"></i></i></i></h2>

<img src="public/images/chain1.png" class="left-chain"> 	
<img src="public/images/chain1.png" class="right-chain">
<img src="public/images/nail1.png" class="front-first-panel-left-nail">
<img src="public/images/nail1.png" class="front-first-panel-right-nail">

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

<img src="public/images/nail1.png" class="front-first-panel-second-level-left-nail">
<img src="public/images/nail1.png" class="front-first-panel-second-level-right-nail">

<div class="second-level-first-panel-post">
	<?php
	foreach ($comment as $key => $value) {
		?>
		<p><strong><?= $value->getAuthor() ?></strong><?= mb_strimwidth($value->getCommentDate(), 0, 22) ?></p>
		<p><?= $value->getComment() ?></p>
		
		<?php
		if ($value->getReported() === '1' AND isset($_GET['ticket'])) {
                ?>
                <p class="reported">(message en attente de modération)<br /></p>
                <?php
        }
        elseif ($value->getReported() === '0' AND isset($_GET['ticket']))
        {
            $thisComment = $value->getCommentId();
            ?>
            <a class="report-it" href="index.php?action=report&amp;comment=<?= $thisComment ?>&amp;id=<?=$_GET['ticket']?>&amp;ticket=<?= $_GET['ticket'] ?>&amp;episode=<?= $_GET['episode'] ?>">(signaler un abus)<br /></a>
        	<?php
    	}
    	elseif ($value->getReported() === '1' AND !isset($_GET['ticket']))
    	{
    		$thisComment = $value->getCommentId();
            ?>
            <p class="reported">(message en attente de modération)<br /></p>
        	<?php
    	}
    	elseif ($value->getReported() === '0' AND !isset($_GET['ticket']))
    	{
    		$thisComment = $value->getCommentId();
            ?>
            <a class="report-it" href="index.php?action=report&amp;comment=<?= $thisComment ?>&amp;id=<?= $lastTicket->getPostId() ?>&amp;ticket=<?= $lastTicket->getPostId() ?>&amp;episode=<?= $lastEpisode->getPostId() ?>">(signaler un abus)<br /></a>
        	<?php
    	}
    	?>
    	<br />
    	<?php

    }
	?>
</div>


<?php
if (isset($_GET['ticket'])) {
	
$postManager = new JeanForteroche\Blog\Model\PostManager();
        $ticket = $postManager->getPost($_GET['ticket']);
        
        ?>
        <form class="ticket-comment-form" action="index.php?action=addComment&amp;ticket=<?= $_GET['ticket'] ?>&amp;episode=<?= $_GET['episode'] ?>&amp;type=ticket&amp;post=<?= $_GET['ticket'] ?>" method="post" id="ticket-comment-form">
            <div>
                <label for="author">Pseudo</label><br />
                <input type="text" id="author" name="author" required/>
            </div>
            <div>
                <label for="comment">Commentaire</label><br />
                <textarea class="comment" name="comment" required></textarea>
            </div>
            <div>
                <input type="submit" />
            </div>
        </form>
<?php
} 
else 
{
	$episode = $postManager->getLastEpisode();
	?>
	<div class="leave-comment">
		<a href="index.php?ticket=<?= $ticket->getPostId() ?>&amp;episode=<?= $episode->getPostId() ?>#ticket-comment-form">Laisser un commentaire</a>
	</div>
	
	<?php
}
?>

