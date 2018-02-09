<?php

require_once('model/CounterManager.php');

$postId = $_GET['id'];
$ip = $_SERVER['REMOTE_ADDR'];
$postType = $post->getType();

$counterManager = new JeanForteroche\Blog\Model\CounterManager();
$counterManager->setCount($postId, $ip, $postType);



