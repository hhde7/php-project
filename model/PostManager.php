<?php

namespace JeanForteroche\Blog\Model;
use JeanForteroche\Blog\Model\Post;
require_once('model/Manager.php');
require_once('model/Post.php');

class PostManager extends Manager
{
    
    public function getAllEpisodes()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creationDateFr, type FROM posts WHERE type = "episode" ');
        $data = $req->fetchAll();
        $allPosts = array();
        for ($i=0; $i < count($data) ; $i++) {
            $post = new Post($data[$i]);
            $allPosts[] = $post;
        }
     
        return $allPosts;
    }

    public function getAllTickets()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creationDateFr, type FROM posts WHERE type = "ticket" ');
        $data = $req->fetchAll();
        $allTickets = array();
        for ($i=0; $i < count($data) ; $i++) {
            $ticket = new Post($data[$i]);
            $allTickets[] = $ticket;
        }
     
        return $allTickets;
    }

    public function getPosts($pagesNumber)
    {
    	$db = $this->dbConnect();
        $relatedPosts = $db->prepare('SELECT id, title, content, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creationDateFr, type FROM posts WHERE id  BETWEEN ? AND ? ');


        // a mettre dans le controller 
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
        // --------------------------
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
    	$req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creationDateFr, type FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $data = $req->fetch();
        $post = new Post($data);
     
        return $post;
    }

    public function getLastEpisode()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creationDateFr, type FROM posts WHERE type = "episode" ORDER BY creationDate DESC LIMIT 1');
        $data = $req->fetch();
        $lastPost = new Post($data);

        return $lastPost;
    }

     public function getLastTicket()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creationDateFr, type FROM posts WHERE type = "ticket" ORDER BY creationDate DESC LIMIT 1');
        $data = $req->fetch();
        $lastTicket = new Post($data);

        return $lastTicket;
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