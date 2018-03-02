<?php
require_once "model/CounterManager.php";

if (!isset($_GET['ticket']) or !isset($_GET['episode'])) {
    $episodeId = $lastEpisode->getPostId();
    $ticketId = $lastTicket->getPostId();
} elseif (isset($_GET['ticket']) and isset($_GET['episode'])) {
    $episodeId = $_GET['episode'];
    $ticketId = $_GET['ticket'];
}

$counterManager->setCount($episodeId, $ip, 'episode');
$counterManager->setCount($ticketId, $ip, 'ticket');
