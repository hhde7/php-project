<ul>
	<?php
    $episodes = array_reverse($episodes);
    foreach ($episodes as $key => $value) {
        ?>
		<li><a href="index.php?ticket=<?= $lastTicket->getPostId() ?>&amp;episode=<?= $value->getPostId() ?>"><?= mb_strimwidth($value->getTitle(), 0, 15, '..') ?></a></li>
	<?php
    }
?>
</ul>
