<?php 

require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/MemberManager.php');

class Controller 
{
	public function post()
	{
		$postManager = new JeanForteroche\Blog\Model\PostManager();
		$postStatus = $postManager->postCheck($_GET['id']);

		$commentManager = new JeanForteroche\Blog\Model\CommentManager();
		
		if (empty($postStatus))	{
			throw new Exception('Le billet ' . $_GET['id'] . ' n\'existe pas');
		} else 	{
			$post = $postManager->getPost($_GET['id']);
			$comments = $commentManager->getAllComments($_GET['id']);
			
			require('view/frontend/postView.php');
		}
	}

	public function listPosts()
	{
		$nb_pages = new JeanForteroche\Blog\Model\PostManager();
		$pagesNumber = $nb_pages->paging();

		$postManager = new JeanForteroche\Blog\Model\PostManager();
		$relatedPosts = $postManager->getPosts($pagesNumber);

		require('view/frontend/listPostsView.php');
	}

	public function addComment($postId, $postType, $author, $comment)
	{
		$commentManager = new JeanForteroche\Blog\Model\CommentManager();
		$newCommentDatas = $commentManager->postComment($postId, $postType, $author, $comment);

		if ($newCommentDatas === false) {
			throw new Exception('Impossible d\'ajouter le commentaire !');
		}
		else {
			header('location: index.php?action=post&id=' . $postId);
		}
	}

	public function reportComment($commentId)
	{	
		$commentManager = new JeanForteroche\Blog\Model\CommentManager();
		$commentManager->reportBadComment($commentId);

		require('view/frontend/reportView.php');
	}

	public function confirmReport($commentId)
	{	
		require('view/frontend/reportView.php');
	}

	public function displayModeratePage()
	{
		require('view/backend/moderateView.php');
	}

	public function moderateComments($id, $action)
	{
		$commentManager = new JeanForteroche\Blog\Model\CommentManager();
		if (isset($action) AND $action == 'delete') {
			$commentManager->deleteComment($id);
		} elseif (isset($action) AND $action == 'allow') {
			$commentManager->allowComment($id);
		} else {
			throw new Exception('impossible de modérer ce commentaire');	
		}
	}

	public function loginPage()
	{
		require('view/frontend/loginView.php');
	}

	public function loginCheck($email, $password)
	{
		$memberManager = new JeanForteroche\Blog\Model\MemberManager();
		$member = $memberManager->memberCheck($email, $password);

		if ($member->getEmail() !== $email OR $member->getPassword() !== $password) {
			throw new Exception('Les identifiants sont incorrects');
		}
		else {
			$_SESSION['email'] = $email;
			$_SESSION['password'] = $password;
			header('location: index.php?action=dashboard');
		}
	}

	public function displayDashboard()
	{	
		require('view/backend/dashboardView.php');
	}

	public function displayArticleWriter()
	{
		require('view/backend/articleWriter.php');
	}

	public function logout()
	{
		session_destroy();
	    
	    header( "Location: index.php");
	}
}