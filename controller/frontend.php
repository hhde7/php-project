<?php 

require_once('model/PostManager.php');
require_once('model/CommentManager.php');

class Controller 
{
	public function listPosts()
	{
		$nb_pages = new JeanForteroche\Blog\Model\PostManager();
		$pagesNumber = $nb_pages->paging();

		$postManager = new JeanForteroche\Blog\Model\PostManager();
		$relatedPosts = $postManager->getPosts($pagesNumber);

		require('view/frontend/listPostsView.php');
	}

	public function post()
	{
		$postManager = new JeanForteroche\Blog\Model\PostManager();
		$postStatus = $postManager->postCheck($_GET['id']);

		$commentManager = new JeanForteroche\Blog\Model\CommentManager();
		
		if (empty($postStatus))	{
			throw new Exception('Le billet ' . $_GET['id'] . ' n\'existe pas');
		} else 	{
			$post = $postManager->getPost($_GET['id']);
			$comments = $commentManager->getComments($_GET['id']);
			
			require('view/frontend/postView.php');
		}
	}

	public function addComment($postId, $author, $comment)
	{
		$commentManager = new JeanForteroche\Blog\Model\CommentManager();
		$affectedLines = $commentManager->postComment($postId, $author, $comment);

		if ($affectedLines === false) {
			throw new Exception('Impossible d\'ajouter le commentaire !');
		}
		else {
			header('location: index.php?action=post&id=' . $postId);
		}
	}
}