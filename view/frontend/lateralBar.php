<?php

require_once('model/CommentManager.php');
require_once('model/CounterManager.php');


$commentManager = new JeanForteroche\Blog\Model\CommentManager;
$postManager = new JeanForteroche\Blog\Model\PostManager;

?>

<div class="col-lg-1 col-lg-push-11 right-bar" >
<?php
include('profil.php');
?>
<p class="right-bar-episode-title">LES ÉPISODES</p>
<?php
include('allEpisodesTitles.php');
?>
		
</div>

