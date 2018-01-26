<?php

namespace JeanForteroche\Blog\Model;

require_once('model/Manager.php');

class PostManager extends Manager
{
    public function getPosts($pagesNumber)
    {
    	$db = $this->dbConnect();
        $relatedPosts = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id  BETWEEN ? AND ? ');

        if (!isset($_GET['page']) OR $_GET['page'] == 1 AND is_numeric($_GET['page']))
        {
            $_GET['page'] = 1;
            $relatedPosts->execute(array($_GET['page'], $_GET['page']+9));
        }
        elseif (isset($_GET['page'])
                AND $_GET['page'] <= $pagesNumber 
                AND $_GET['page'] >= 1 
                AND is_numeric($_GET['page'])
               )
        {
            $relatedPosts ->execute(array($_GET['page']*10-9, $_GET['page']*10));
        }
        else
        {
            throw new \Exception('Page inexistante');
        }
 
        return $relatedPosts;
    }

    public function nb_posts()
    {
        $db = $this->dbConnect();
        $answer = $db->query('SELECT COUNT(*) FROM posts');
        $nb_posts = $answer->fetch();

        return $nb_posts;
    }

    public function paging()
    {
        $nb_posts = $this->nb_posts();
        $nb_pages = ceil(($nb_posts[0] / 10));

        return $nb_pages;
    }

    public function getPost($postId)
    {
    	$db = $this->dbConnect(); 
    	$req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();
        
        return $post;
    }

    public function postCheck($postId)
    {
        $db = $this->dbConnect(); 
        $req = $db->prepare('SELECT id FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $postStatus = $req->fetch();
        
        return $postStatus;
    }
}