<div class="col-lg-4 col-lg-push-1 col-md-4 col-md-push-1 col-sm-8 col-sm-pull-1 col-xs-12 second-panel second-panel-back second-panel-second-level-back" id="post-link">
	<h2 class="second-panel-title">MODIFIER UN <?= $type ?></h2>
	<div class="chains-nails-contener">
    	<div>
			<img src="public/images/chain2.png" alt="" class="back-second-panel-left-chain"> 	
			<img src="public/images/chain2.png" alt="" class="back-second-panel-right-chain">
			<img src="public/images/nail1.png" alt="" class="back-second-panel-left-nail-article-editor">
			<img src="public/images/nail1.png" alt="" class="back-second-panel-right-nail-article-editor">
		</div>
	</div>
	<form name="formulaire" id="formulaire" action="index.php?action=<?= $_GET['action'] ?>&amp;update=<?= $_GET['edit'] ?>&amp;type=<?= $_GET['type'] ?>&amp;from=allEpisodes&amp;page=<?= $_GET['page'] ?>" method="post">
	    <label>Titre :</label><br />
	    <input type="text" value="<?= $episode->getTitle() ?>" class="title" name="title" maxlength="45" required/><br />
	    <label class="date-of-publication"><?= $originalDate ?></label><br />
	   	<label>Saisir la date</label><br />
	    <input type="datetime-local" value="<?= $date ?>" class="form-datetime" name="creationDate" required><br />
	    <label>Contenu :</label><br />
	    <textarea class="tinymce" id="writer" name="content"><?= $episode->getContent() ?></textarea>
	    <input type="submit" value ="Valider" class="submit" name="submit">
	</form>
</div>