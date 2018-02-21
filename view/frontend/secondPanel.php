<h2 class="second-panel-title">BILLET SIMPLE POUR L'ALASKA - ÉPISODE <?= mb_strimwidth($episode_->getTitle(),0,2) ?> <i class="fab fa-envira"></i></i></i></h2>

<img src="public/images/chain1.png" class="front-second-panel-left-chain"> 	
<img src="public/images/chain1.png" class="front-second-panel-right-chain">
<img src="public/images/nail1.png" class="front-second-panel-left-nail">
<img src="public/images/nail1.png" class="front-second-panel-right-nail">

<div class="first-panel-post">

	<p class="first-panel-post-title episode-number"><?= mb_strimwidth($episode_->getTitle(),0,2) ?></p>
	<p class="first-panel-post-title"><?= mb_strimwidth($episode_->getTitle(),2,100) ?></p>
	<p class="first-panel-post-date"><?= $episode_->getCreationDate() ?></p>
	<p class="first-panel-post-content"><?= $episode_->getContent() ?></p>
</div>

<div id="nav-control">
	<?= $previousEpisodeLink ?>
	<?= $nextEpisodeLink ?>
</div>

   
<?php

$comment = $commentManager->getAllComments($episode_->getPostId());
?>
<h2 class="second-panel-title">COMMENTAIRES <i class="fa fa-comments"></i></i></i></h2>

<img src="public/images/nail1.png" class="front-second-panel-second-level-left-nail">
<img src="public/images/nail1.png" class="front-second-panel-second-level-right-nail">

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
            <a class="report-it" href="index.php?action=report&amp;comment=<?= $thisComment ?>&amp;id=<?=$_GET['ticket']?>&amp;ticket=<?= $_GET['ticket'] ?>&amp;episode=<?= $_GET['episode'] ?>">signaler un abus<br /></a>
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
            <a class="report-it" href="index.php?action=report&amp;comment=<?= $thisComment ?>&amp;id=<?= $lastTicket->getPostId() ?>&amp;ticket=<?= $lastTicket->getPostId() ?>&amp;episode=<?= $lastEpisode->getPostId() ?>">signaler un abus<br /></a>
        <?php
    	}
    	?>
    	<br />
    	<?php

	}
	?>
</div>	

<?php
if (isset($_GET['episode'])) {
	
$postManager = new JeanForteroche\Blog\Model\PostManager();
        $ticket = $postManager->getPost($_GET['episode']);
        
        ?>
        <form class="episode-comment-form"  action="index.php?action=addComment&amp;ticket=<?= $_GET['ticket'] ?>&amp;episode=<?= $_GET['episode'] ?>&amp;type=episode&amp;post=<?= $_GET['episode'] ?>" method="post" id="episode-comment-form">
            <div>
                <label for="author">Pseudo</label><br />
                <input type="text" id="author" name="author" required/>
            </div>
            <div>
                <label for="comment">Commentaire</label><br />
                <textarea class="comment" name="comment" required></textarea>
            </div>
            <div>
                <input type="submit" class="submit" />
            </div>
        </form>
<?php
} 
else 
{
	$episode = $postManager->getLastEpisode();
	?>
	<div class="leave-comment">
	<a href="index.php?ticket=<?= $ticket->getPostId() ?>&amp;episode=<?= $episode->getPostId() ?>#episode-comment-form">Laisser un commentaire</a>
</div>
	
	<?php
}
?>