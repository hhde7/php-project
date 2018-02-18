<?php 
require_once('model/PostManager.php');
$postManager = new  JeanForteroche\Blog\Model\PostManager();
$episode = $postManager->getPost($_GET['edit']);
$type = $episode->getType();

// Conversion creationDate en datetime-local
$originalDate = $episode->getCreationDate();
$date = mb_strimwidth($originalDate, 10,18);
$date = str_replace('h', ':', $date);
$dmY = mb_strimwidth($originalDate, 10,10);
$dmY = strtotime($dmY);
$Ymd = date('Y-m-d', $dmY);
$date = $Ymd . 'T' . mb_strimwidth($date, 13,2) . ':' . mb_strimwidth($date, 16,2);


if ($type == 'episode') {
	$type = 'ÉPISODE <i class="fab fa-envira"></i>';
} elseif ($type == 'ticket') {
	$type = 'BILLET <i class="fas fa-bullhorn"></i>';
}


?>

<div class="col-lg-4 col-lg-push-1 second-panel">

	<h2 class="first-panel-title">MODIFIER UN <?= $type ?></h2>

	<img src="public/images/chain1.png" class="left-chain"> 	
	<img src="public/images/chain1.png" class="right-chain">
	<img src="public/images/nail1.png" class="left-nail">
	<img src="public/images/nail1.png" class="right-nail">

	<form name="formulaire" id="formulaire" action="index.php?action=<?= $_GET['action'] ?>&amp;update=<?= $_GET['edit'] ?>&amp;type=<?= $_GET['type'] ?>&amp;from=allEpisodes" method="post">
	    <label>Titre :</label><br />
	    <input type="text" value="<?= $episode->getTitle() ?>" id="title" name="title" /><br />
	    <label class="date-of-publication"><?= $originalDate ?></label><br />
	   	<label>Modifier la date</label><br />
	    <input type="datetime-local" value="<?= $date ?>" name="creationDate" ><br />
	    <label>Contenu :</label><br />
	    <textarea class="tinymce" id="writer" name="content" ><?= $episode->getContent() ?></textarea>
	    <input type="submit" value ="Valider" id="submit" name="submit">
	</form>
</div>