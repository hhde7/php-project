<?php 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mon blog</title>
        <link href="public/css/style.css" rel="stylesheet" /> 
    </head>
        
    <body>
        <h1>Mon super blog !</h1>
        <p><a href="index.php?action=listPosts">Retour à la liste des billets</a></p>

        <div class="news">
            <h3>
                <?= htmlspecialchars($post['title']) ?>
                <em>le <?= $post['creation_date_fr'] ?></em>
            </h3>
            
            <p>
                <?= nl2br(htmlspecialchars($post['content'])) ?>
            </p>
            <div id="navControl">
                <?php
                if (isset($_GET['id']) AND $_GET['id'] > 1 ) {
                    ?>
                    <a id="previousPost" href="index.php?action=post&id=<?=$_GET['id'] - 1 ?>">Précédent</a>
                    <?php
                }
                $lastPostId = new JeanForteroche\Blog\Model\PostManager();
                $nb_posts = $lastPostId->nb_posts();

                if (isset($_GET['id']) AND $_GET['id'] < $nb_posts[0] ) {
                    ?>
                    <a id="nextPost" href="index.php?action=post&id=<?=$_GET['id'] + 1 ?>">Suivant</a>
                    <?php
                    }
                    ?>    
            </div>
        </div>

        <h2>Commentaires</h2>

        <?php
        $commentManager = new JeanForteroche\Blog\Model\CommentManager();
        while ($comment = $comments->fetch())
        {
        ?>
            <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
            <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
            <?php
            if (isset($_GET['report'])) {
                $reportComment = $commentManager->reportComment($_GET['report']); 
            }
            
            $commentStatus = $commentManager->commentStatus($comment['id']);
            if (isset($commentStatus) AND $commentStatus['status'] == 'reported') {
            ?>
                <p id="reported">(message en attente de modération)</p>
            <?php 
            } else {
            ?>
                <a href="index.php?action=post&amp;report=<?=$comment['id']?>&amp;id=<?= $post['id'] ?>">(signaler un abus)</a>
            <?php
            }
        }
        ?>
        <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
            <div>
                <label for="author">Auteur</label><br />
                <input type="text" id="author" name="author" />
            </div>
            <div>
                <label for="comment">Commentaire</label><br />
                <textarea id="comment" name="comment" ></textarea>
            </div>
            <div>
                <input type="submit" />
            </div>
        </form>
    </body>
</html>