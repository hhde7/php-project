<?php

namespace JeanForteroche\Blog\Model;
use JeanForteroche\Blog\Model\Comment;
use JeanForteroche\Blog\Model\Post;
require_once ('model/Manager.php');
require_once ('model/Comment.php');
require_once ('model/Post.php');

class CommentManager extends Manager
{
	public function getAllComments($postId)
	{
	    $db = $this->dbConnect(); 
	    $req = $db->prepare('SELECT id, postId, postType, author, comment, DATE_FORMAT(commentDate, \' le %d/%m/%Y à %Hh%imin%ss\') AS commentDateFr, reported FROM comments WHERE postId = ? ORDER BY commentDateFr DESC');
	    $req->execute(array($postId));
	    $data = $req->fetchAll();
	    $allComments = array();
	    /* foreach */
	    for ($i=0; $i < count($data) ; $i++) {
	       	$comment = new Comment($data[$i]);
	       	$allComments[] = $comment;
       	}
	 
       	return $allComments;
    }

    public function getLastComments()
    {
    	$db = $this->dbConnect();
    	$req = $db->query('SELECT id, postId, author, postType, comment, DATE_FORMAT(commentDate, \' le %d/%m/%Y à %Hh%imin%ss\') AS commentDateFr, reported FROM comments ORDER BY commentDate DESC LIMIT 10');
    	$data = $req->fetchAll();
    	$lastComments = array();
	    for ($i=0; $i < count($data) ; $i++) {
	       	$comment = new Comment($data[$i]);
	       	$lastComments[] = $comment;
       	}
	 
       	return $lastComments;

    }

     public function getMostCommentedArticle($type)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT postId, COUNT(*) FROM comments WHERE postType = ? GROUP BY postId ORDER BY COUNT(*) DESC LIMIT 1' );
        $req->execute(array($type));
        $postId = $req->fetch(); 
     	

        return $postId[0];
    }

	public function postComment($postId, $postType, $author, $comment)
	{
	    $db = $this->dbConnect();
	    $req = $db->prepare('INSERT INTO comments (postId, author, postType, comment, commentDate, reported) VALUES(:postId, :author, :postType, :comment, :commentDate, :reported)');
	    $commentDate = date("Y-m-d H:i:s");
	    $reported = 0;
	    $req->bindParam(':postId', $postId);
	    $req->bindParam(':author', $author);
	    $req->bindParam(':postType', $postType);
	    $req->bindParam(':comment', $comment);
	    $req->bindParam(':commentDate', $commentDate);
	    $req->bindParam(':reported', $reported);
	    $newCommentDatas = $req->execute();
	    
	    return $newCommentDatas;
	}

	public function reportBadComment($commentId)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE comments SET reported = 1 WHERE id = ?');
        $data = $req->execute(array($commentId));
        
	    return $data;
	}

	public function getAllReportedComments()
	{
	    $db = $this->dbConnect(); 
		$req = $db->query('SELECT id, postId, postType, author, comment, DATE_FORMAT(commentDate, \' le %d/%m/%Y à %Hh%imin%ss\') AS commentDateFr, reported FROM comments WHERE reported = 1');
	    $data = $req->fetchAll();
	   	$reportedComments = array();
	   	for ($i=0; $i < count($data); $i++) { 
	    	$comment = new Comment($data[$i]);
			$reportedComments[] = $comment;   
	   	}
	 	    
	    return $reportedComments;
	}

	public function deleteComment($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('DELETE FROM comments WHERE id = ?');
		$req->execute(array($id));
		$message = 'Commentaire supprimé';

		return $message;
	}

	public function allowComment($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE comments SET reported = 0 WHERE id = ?');
		$req->execute(array($id));
		$message = 'Commentaire accepté';

		return $message;
	}

}