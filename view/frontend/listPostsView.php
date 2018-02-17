<?php

require_once('model/PostManager.php');

$title = 'Mon blog'; ?>

<?php ob_start(); ?>

<h1>Jean Forteroche</h1>
<p>Derniers billets du blog :</p>

<p id="pagination">Allez à la page :     
<?php
$postManager = new JeanForteroche\Blog\Model\PostManager();
$pagesNumber = $postManager->paging();

for ($i=0; $i < $pagesNumber; $i++) {
?>
    <a href="index.php?action=listPosts&page=<?= $i+1 ?>"><?= $i+1 ?></a>
<?php 
}
?>
</p>

<?php
while ($data = $relatedPosts->fetch())
{
?>
    <div class="news">
        <h3>
            <?= htmlspecialchars($data['title']) ?>
            <em>le <?= $data['creationDateFr'] ?></em>
        </h3>
            
        <p>
            <?= nl2br($data['content']) ?>
            <br />
            <em><a href="index.php?action=post&id=<?= $data['id'] ?>">Commentaires</a></em>
        </p>
    </div>
<?php
}
$relatedPosts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>
