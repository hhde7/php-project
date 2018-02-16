<?php 
require_once('model/PostManager.php');
$postManager = new  JeanForteroche\Blog\Model\PostManager();
$episode = $postManager->getPost($_GET['edit']);

?>

<div class="col-lg-5">

	<form name="formulaire" id="formulaire" action="index.php?action=<?= $_GET['action'] ?>&amp;update=<?= $_GET['edit'] ?>&amp;type=<?= $_GET['type'] ?>" method="post">
	    <label>Titre de l'épisode :</label><br />
	    <input type="text" value="<?= $episode->getTitle() ?>" name="title" size="60" ><br />
	    <label>Date de publication :</label><br />
	    <input type="date" value="<?= $episode->getCreationDate() ?>" size="60" ><br />
	    <textarea class="tinymce" id="writer" name="content" rows="25" ><?= $episode->getContent() ?></textarea>
	    <input type="submit" value ="Valider" name="">
	</form>
</div>