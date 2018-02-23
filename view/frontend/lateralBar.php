<?php

require_once('model/CommentManager.php');
require_once('model/CounterManager.php');


$commentManager = new JeanForteroche\Blog\Model\CommentManager;
$postManager = new JeanForteroche\Blog\Model\PostManager;

?>

<div class="col-lg-1 col-lg-push-11 col-md-1 col-md-push-11 col-sm-2 col-sm-push-10 hidden-xs right-bar" >
<?php
include('profil.php');
?>
<p class="right-bar-episode-title mobile-episode-title">LES ÉPISODES</p>
<?php
include('allEpisodesTitles.php');
?>
		
</div>

