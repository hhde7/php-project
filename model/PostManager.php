<?php
namespace JeanForteroche\Blog\Model;

class PostManager extends Manager
{
    public function getAllPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creationDateFr, type FROM posts');
        $data = $req->fetchAll();
        $allPosts = array();

        for ($i=0; $i < count($data) ; $i++) {
            $post = new Post($data[$i]);
            $allPosts[] = $post;
        }

        return $allPosts;
    }

    public function getAllEpisodes()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creationDateFr, type FROM posts WHERE type = "episode" ORDER BY creationDate DESC ');
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
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creationDateFr, type FROM posts WHERE type = "ticket" ORDER BY creationDate DESC ');
        $data = $req->fetchAll();
        $allTickets = array();

        for ($i=0; $i < count($data) ; $i++) {
            $ticket = new Post($data[$i]);
            $allTickets[] = $ticket;
        }

        return $allTickets;
    }

    public function nb_posts($type)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT COUNT(*) FROM posts WHERE type = ?');
        $req->execute(array($type));
        $nb_posts = $req->fetch();

        return $nb_posts;
    }

    public function paging($type)
    {
        $nb_posts = $this->nb_posts($type);
        $nb_pages = ceil(($nb_posts[0] / 20));

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

    public function getFirstEpisode()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creationDateFr, type FROM posts WHERE type = "episode" ORDER BY creationDate ASC LIMIT 1');
        $data = $req->fetch();
        $lastPost = new Post($data);

        return $lastPost;
    }

    public function getFirstTicket()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creationDateFr, type FROM posts WHERE type = "ticket" ORDER BY creationDate ASC LIMIT 1');
        $data = $req->fetch();
        $lastTicket = new Post($data);

        return $lastTicket;
    }

    public function newPost($title, $content, $type)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO posts (title, content, creationDate, type) VALUES(:title, :content, :creationDate, :type)');
        $creationDate = date("Y-m-d H:i:s");
        $req->bindParam(':title', $title);
        $req->bindParam(':content', $content);
        $req->bindParam(':creationDate', $creationDate);
        $req->bindParam(':type', $type);
        $newPostData = $req->execute();

        return $newPostData;
    }

    public function deletePost($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM posts WHERE id = ?');
        $req->execute(array($id));
        $message = 'article supprimé';

        return $message;
    }

    public function updatePost($id, $title, $content, $creationDate, $type)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET title = :title, content = :content, creationDate = :creationDate, type = :type WHERE id = :id ');
        $req->bindParam(':id', $id);
        $req->bindParam(':title', $title);
        $req->bindParam(':content', $content);
        $req->bindParam(':creationDate', $creationDate);
        $req->bindParam(':type', $type);
        $updatedPost = $req->execute();

        return $updatedPost;
    }

    // PAGINATION ---//
    public function getPreviousPost($id, $type)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creationDateFr, type FROM posts WHERE creationDate < (SELECT creationDate FROM posts WHERE id = ?) AND type = ? ORDER BY creationDate DESC LIMIT 1');
        $req->execute(array($id, $type));
        $data = $req->fetch();
        $post = new Post($data);

        return $post;
    }

    public function getNextPost($id, $type)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creationDateFr, type FROM posts WHERE creationDate > (SELECT creationDate FROM posts WHERE id = ?) AND type = ? ORDER BY creationDate ASC LIMIT 1');
        $req->execute(array($id, $type));
        $data = $req->fetch();
        $post = new Post($data);

        return $post;
    }
}
