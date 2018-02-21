<?php

require_once('model/CommentManager.php');
require_once('model/CounterManager.php');


$commentManager = new JeanForteroche\Blog\Model\CommentManager;
$postManager = new JeanForteroche\Blog\Model\PostManager;
$counterManager = new JeanForteroche\Blog\Model\CounterManager;

?>

<div class="col-lg-2" id="menu">
<?php
	include('menu.php');
?>
	<h2 id="posts-stats-title">MES ARTICLES</h2>
	<img class="cornerd" src="public/images/cornerd.png" />
	<div id="posts-stats">
<?php 
	include('postsStats.php');
?>
	</div>
	<h2 id="readers-stats-title">MES LECTEURS</h2>
	<img class="cornerd" src="public/images/cornerd.png" />
	<div id="readers-stats">
<?php 
	include('readersStats.php');
?>
	</div>
		
</div>