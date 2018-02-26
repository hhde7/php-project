<?php
require_once "model/CounterManager.php";

if (!isset($_GET['ticket']) OR !isset($_GET['episode'])) {
	$episodeId = $lastEpisode->getPostId();
	$ticketId = $lastTicket->getPostId();
}
elseif (isset($_GET['ticket']) AND isset($_GET['episode']))
{
	$episodeId = $_GET['episode'];
	$ticketId = $_GET['ticket'];
}

$counterManager->setCount($episodeId, $ip, 'episode');
$counterManager->setCount($ticketId, $ip, 'ticket');



