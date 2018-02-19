<?php
$postManager = new JeanForteroche\Blog\Model\PostManager();
$episode = $postManager->getAllEpisodes();
$lastTicket = $postManager->getLastTicket();

?>
<ul>
	<?php
	foreach ($episode as $key => $value) {
	?>
		<li><a href="index.php?ticket=<?= $lastTicket->getPostId() ?>&amp;episode=<?= $value->getPostId() ?>"><?= mb_strimwidth($value->getTitle(),0 ,15, '..') ?></a></li>
		<?php
	}
	?>
</ul>
