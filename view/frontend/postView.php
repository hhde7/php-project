<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mon blog</title>
        <link href="public/css/style.css" rel="stylesheet" /> 
    </head>
        
    <body>
        <h1>Articles</h1>
        <p><a href="index.php?action=listPosts">Retour à la liste des billets</a></p>

        <div class="news">
            <h3><?= $post->getTitle().'<em>'.$post->getCreationDate().'</em>' ?></h3>
            <p><?= $post->getContent() ?></p>
            <div id="navControl">
                <?php
                // Liens précédent et suivant
                // Si premier article affiché -> pas de lien vers article précédent
                // Si dernier article affiché -> pas de lien vers article suivant
                if (isset($_GET['id']) AND $_GET['id'] > 1 ) {
                ?>
                    <a id="previousPost" href="index.php?action=post&id=<?=$_GET['id'] - 1 ?>">Précédent</a>
                <?php
                }

                // à mettre dans le controller
                $lastPostId = new JeanForteroche\Blog\Model\PostManager();
                $nb_posts = $lastPostId->nb_posts();
                // ------------------------------
                
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
       
        // Boucle parcourant le tableau d'objets $comments
        for ($i=0; $i < count($comments) ; $i++) {
        ?>

            <p><strong><?= $comments[$i]->getAuthor() ?></strong><em><?= $comments[$i]->getCommentDate() ?></em></p>
            <p><?= $comments[$i]->getComment() ?></p>
            
        
        <?php
            /*  Utilisation d'un "booléen" MySQL de type TINYINT(1) avec :
                FALSE = 0
                TRUE = 1
             */
            if ($comments[$i]->getReported() === '1') {
                ?>
                <p id="reported">(message en attente de modération)</p>
                <?php
            } elseif ($comments[$i]->getReported() === '0') {
                $thisComment = $comments[$i]->getCommentId();
                
                ?>
                <a href="index.php?action=report&amp;comment=<?= $thisComment ?>&amp;id=<?=$_GET['id']?>">(signaler un abus)</a> 
                <?php
            } 
          
        ?>
  
        <?php
        } // Fin de la boucle
        $postManager = new JeanForteroche\Blog\Model\PostManager();
        $post = $postManager->getPost($_GET['id']);
        $postType = $post->getType();
        ?>

        <form action="index.php?action=addComment&amp;id=<?= $_GET['id'] ?>&amp;type=<?= $postType ?>" method="post">
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
        <?php
        include('visitorCounter.php');
        ?>
    </body>
    <?php
    include('footer.php');
    ?>
</html>