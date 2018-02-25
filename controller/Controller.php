<?php 

require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/MemberManager.php');
require_once('model/CounterManager.php');

class Controller 
{

	public function home() // PERMET LA NAVIGATION SIMULTANNÉE ET INDÉPENDANTE ENTRE LES ÉPISODES ET LES BILLETS
	{

		$postManager = new JeanForteroche\Blog\Model\PostManager();
		$commentManager = new JeanForteroche\Blog\Model\CommentManager();
		$counterManager = new JeanForteroche\Blog\Model\CounterManager();
		$ip = $_SERVER['REMOTE_ADDR'];

		$episode = $postManager->getAllEpisodes();

		$firstTicket = $postManager->getFirstTicket();
		$firstEpisode = $postManager->getFirstEpisode();
		$lastTicket = $postManager->getLastTicket();
		$lastEpisode = $postManager->getLastEpisode();

		// SI PAGE DE GARDE OU, DERNIER TICKET ET DERNIER EPISODE 
		if (!isset($_GET['ticket'], $_GET['episode']) OR $_GET['ticket'] == $lastTicket->getPostId() AND $_GET['episode'] == $lastEpisode->getPostId())
		{
			$ticket = $postManager->getLastTicket();
			$episode_ = $postManager->getLastEpisode();//à remplacer $episode
			$previousTicket = $postManager->getPreviousPost($ticket->getPostId(), 'ticket');
			$previousEpisode = $postManager->getPreviousPost($episode_->getPostId(), 'episode');
			$ticketComments = $commentManager->getAllComments($ticket->getPostId());
			$episodeComments = $commentManager->getAllComments($episode_->getPostId());

			$previousTicketLink = '<a class="previous-ticket-link" href="index.php?ticket='. $previousTicket->getPostId() . '&amp;episode=' . $episode_->getPostId() .'"><i class="far fa-hand-point-left fa-lg"></i></a>';
			$nextTicketLink = Null;

			$previousEpisodeLink = '<a class="previous-episode-link" href="index.php?ticket='. $ticket->getPostId() .'&amp;episode='. $previousEpisode->getPostId() .'"><i class="far fa-hand-point-left fa-lg"></i></a>';
			$nextEpisodeLink = Null; 		
		} 
		elseif (isset($_GET['ticket']) AND isset($_GET['episode']))
		{
			$ticket = $postManager->getPost($_GET['ticket']);
			$episode_ = $postManager->getPost($_GET['episode']);//à remplacer $episode
			$previousTicket = $postManager->getPreviousPost($ticket->getPostId(), 'ticket');
			$previousEpisode = $postManager->getPreviousPost($episode_->getPostId(), 'episode');
			$nextTicket = $postManager->getNextPost($_GET['ticket'], 'ticket');
			$nextEpisode = $postManager->getNextPost($_GET['episode'], 'episode');
			$ticketComments = $commentManager->getAllComments($ticket->getPostId());
			$episodeComments = $commentManager->getAllComments($episode_->getPostId());

			// SI PREMIER TICKET ET PREMIER EPISODE
			if ($_GET['ticket'] == $firstTicket->getPostId() AND $_GET['episode'] == $firstEpisode->getPostId())
			{	
				$previousTicketLink = Null;
				$nextTicketLink = '<a class="next-ticket-link" href="index.php?ticket='. $nextTicket->getPostId() . '&amp;episode=' . $episode_->getPostId() .'"><i class="far fa-hand-point-right fa-lg"></i></a>';

				$previousEpisodeLink = Null;
				$nextEpisodeLink = '<a class="next-episode-link" href="index.php?ticket='. $ticket->getPostId() .'&amp;episode='. $nextEpisode->getPostId() .'"><i class="far fa-hand-point-right fa-lg"></i></a>';
			}
			// SI PREMIER TICKET, ET UN EPISODE != DU DERNIER
			elseif ($_GET['ticket'] == $firstTicket->getPostId() AND $_GET['episode'] != $lastEpisode->getPostId()) 
			{
				$previousTicketLink = Null;
				$nextTicketLink = '<a class="next-ticket-link" href="index.php?ticket='. $nextTicket->getPostId() . '&amp;episode=' . $episode_->getPostId() .'"><i class="far fa-hand-point-right fa-lg"></i></a>';
				
				$previousEpisodeLink = '<a class="previous-episode-link" href="index.php?ticket='. $ticket->getPostId() .'&amp;episode='. $previousEpisode->getPostId() .'"><i class="far fa-hand-point-left fa-lg"></i></a>';
				$nextEpisodeLink = '<a class="next-episode-link" href="index.php?ticket='. $ticket->getPostId() .'&amp;episode='. $nextEpisode->getPostId() .'"><i class="far fa-hand-point-right fa-lg"></i></a>';
			}
			// SI PREMIER TICKET ET DERNIER EPISODE
			elseif ($_GET['ticket'] == $firstTicket->getPostId() AND $_GET['episode'] == $lastEpisode->getPostId()) 
			{	
				$previousTicketLink = Null;
				$nextTicketLink = '<a class="next-ticket-link" href="index.php?ticket='. $nextTicket->getPostId() . '&amp;episode=' . $episode_->getPostId() .'"><i class="far fa-hand-point-right fa-lg"></i></a>';

				$previousEpisodeLink = '<a class="previous-episode-link" href="index.php?ticket='. $ticket->getPostId() .'&amp;episode='. $previousEpisode->getPostId() .'"><i class="far fa-hand-point-left fa-lg"></i></a>';
				$nextEpisodeLink = Null; 	
			}
			// SI UN TICKET != PREMIER ET DERNIER EPISODE
			elseif ($_GET['ticket'] != $firstTicket->getPostId() AND $_GET['episode'] == $lastEpisode->getPostId())
			{
				
				$previousTicketLink = '<a class="previous-ticket-link" href="index.php?ticket='. $previousTicket->getPostId() . '&amp;episode=' . $episode_->getPostId() .'"><i class="far fa-hand-point-left fa-lg"></i></a>';
				$nextTicketLink = '<a class="next-ticket-link" href="index.php?ticket='. $nextTicket->getPostId() . '&amp;episode=' . $episode_->getPostId() .'"><i class="far fa-hand-point-right fa-lg"></i></a>';

				$previousEpisodeLink = '<a class="previous-episode-link" href="index.php?ticket='. $ticket->getPostId() .'&amp;episode='. $previousEpisode->getPostId() .'"><i class="far fa-hand-point-left fa-lg"></i></a>';
				$nextEpisodeLink = Null;
			}
			// SI UN TICKET != (PREMIER & DERNIER) ET EPISODE != (PREMIER & DERNIER)
			elseif ($_GET['ticket'] != $firstTicket->getPostId() AND
					$_GET['ticket'] != $lastTicket->getPostId() AND
					$_GET['episode'] != $firstEpisode->getPostId() AND
					$_GET['episode'] != $lastEpisode->getPostId())
			{
				$previousTicketLink = '<a class="previous-ticket-link" href="index.php?ticket='. $previousTicket->getPostId() . '&amp;episode=' . $episode_->getPostId() .'"><i class="far fa-hand-point-left fa-lg"></i></a>';
				$nextTicketLink = '<a class="next-ticket-link" href="index.php?ticket='. $nextTicket->getPostId() . '&amp;episode=' . $episode_->getPostId() .'"><i class="far fa-hand-point-right fa-lg"></i></a>';

				$previousEpisodeLink = '<a class="previous-episode-link" href="index.php?ticket='. $ticket->getPostId() .'&amp;episode='. $previousEpisode->getPostId() .'"><i class="far fa-hand-point-left fa-lg"></i></a>';
				$nextEpisodeLink = '<a class="next-episode-link" href="index.php?ticket='. $ticket->getPostId() .'&amp;episode='. $nextEpisode->getPostId() .'"><i class="far fa-hand-point-right fa-lg"></i></a>';
			}
			// SI DERNIER TICKET ET PREMIER EPISODE
			elseif ($_GET['ticket'] == $lastTicket->getPostId() AND $_GET['episode'] == $firstEpisode->getPostId())
			{
				$previousTicketLink = '<a class="previous-ticket-link" href="index.php?ticket='. $previousTicket->getPostId() . '&amp;episode=' . $episode_->getPostId() .'"><i class="far fa-hand-point-left fa-lg"></i></a>';
				$nextTicketLink = Null;

				$previousEpisodeLink = Null;
				$nextEpisodeLink = '<a class="next-episode-link" href="index.php?ticket='. $ticket->getPostId() .'&amp;episode='. $nextEpisode->getPostId() .'"><i class="far fa-hand-point-right fa-lg"></i></a>';
			}
			// SI DERNIER TICKET ET UN EPISODE != (PERMIER & DERNIER)
			elseif ($_GET['ticket'] == $lastTicket->getPostId() AND
					$_GET['episode'] != $firstEpisode->getPostId() AND
					$_GET['episode'] != $lastEpisode->getPostId()) 
			{
				$previousTicketLink = '<a class="previous-ticket-link" href="index.php?ticket='. $previousTicket->getPostId() . '&amp;episode=' . $episode_->getPostId() .'"><i class="far fa-hand-point-left fa-lg"></i></a>';
				$nextTicketLink = Null;

				$previousEpisodeLink = '<a class="previous-episode-link" href="index.php?ticket='. $ticket->getPostId() .'&amp;episode='. $previousEpisode->getPostId() .'"><i class="far fa-hand-point-left fa-lg"></i></a>';
				$nextEpisodeLink = '<a class="next-episode-link" href="index.php?ticket='. $ticket->getPostId() .'&amp;episode='. $nextEpisode->getPostId() .'"><i class="far fa-hand-point-right fa-lg"></i></a>';
			}
			// SI TICKET != (PERMIER & DERNIER) ET DERNIER EPISODE
			elseif ($_GET['ticket'] != $firstTicket->getPostId() AND
					$_GET['ticket'] != $lastTicket->getPostId() AND
					$_GET['episode'] != $lastEpisode->getPostId()) 
			{
				$previousTicketLink = '<a class="previous-ticket-link" href="index.php?ticket='. $previousTicket->getPostId() . '&amp;episode=' . $episode_->getPostId() .'"><i class="far fa-hand-point-left fa-lg"></i></a>';
				$nextTicketLink = '<a class="next-ticket-link" href="index.php?ticket='. $nextTicket->getPostId() . '&amp;episode=' . $episode_->getPostId() .'"><i class="far fa-hand-point-right fa-lg"></i></a>';

				$previousEpisodeLink = Null;
				$nextEpisodeLink = '<a class="next-episode-link" href="index.php?ticket='. $ticket->getPostId() .'&amp;episode='. $nextEpisode->getPostId() .'"><i class="far fa-hand-point-right fa-lg"></i></a>';
			}
		}
		else {
			throw new Exception("Erreur de navigation");	
		}

		require('view/frontend/homeView.php');
	}

	
	public function ticketsMobile()
	{
		$postManager = new JeanForteroche\Blog\Model\PostManager();
		$firstTicket = $postManager->getFirstTicket();
		$firstEpisode = $postManager->getFirstEpisode();
		$lastTicket = $postManager->getLastTicket();
		$lastEpisode = $postManager->getLastEpisode();
		
		$commentManager = new JeanForteroche\Blog\Model\CommentManager();

		if ($_GET['ticket'] == $lastTicket->getPostId()) 
		{
			$ticket = $postManager->getLastTicket();
			$episode_ = $postManager->getLastEpisode();//à remplacer $episode
			$ticketComments = $commentManager->getAllComments($lastTicket->getPostId());
			$previousTicket = $postManager->getPreviousPost($ticket->getPostId(), 'ticket');
			$nextTicket = $postManager->getNextPost($_GET['ticket'], 'ticket');
		
			$previousTicketLink = '<a class="previous-ticket-link" href="index.php?action=mobileTickets&amp;ticket='. $previousTicket->getPostId() . '&amp;episode=' . $episode_->getPostId() .'"><i class="far fa-hand-point-left fa-lg"></i></a>';
			$nextTicketLink = Null;
		}
		elseif ($_GET['ticket'] != $lastTicket->getPostId())
		{
			$ticket = $postManager->getPost($_GET['ticket']);
			$episode_ = $postManager->getPost($_GET['episode']);//à remplacer $episode
			$ticketComments = $commentManager->getAllComments($ticket->getPostId());
			$previousTicket = $postManager->getPreviousPost($ticket->getPostId(), 'ticket');
			$nextTicket = $postManager->getNextPost($_GET['ticket'], 'ticket');

			if (isset($_GET['ticket']) AND $_GET['ticket'] == $firstTicket->getPostId())
			{
				$previousTicketLink = Null;
				$nextTicketLink = '<a class="next-ticket-link" href="index.php?action=mobileTickets&amp;ticket='. $nextTicket->getPostId() . '&amp;episode=' . $episode_->getPostId() .'"><i class="far fa-hand-point-right fa-lg"></i></a>';
			}
			elseif (isset($_GET['ticket']) AND $_GET['ticket'] != $lastTicket->getPostId() AND $_GET['ticket'] != $firstTicket->getPostId())
			{			
				$previousTicketLink = '<a class="previous-ticket-link" href="index.php?action=mobileTickets&amp;ticket='. $previousTicket->getPostId() . '&amp;episode=' . $episode_->getPostId() .'"><i class="far fa-hand-point-left fa-lg"></i></a>';
				$nextTicketLink = '<a class="next-ticket-link" href="index.php?action=mobileTickets&amp;ticket='. $nextTicket->getPostId() . '&amp;episode=' . $episode_->getPostId() .'"><i class="far fa-hand-point-right fa-lg"></i></a>';
			}
		}
			
		require('view/frontend/ticketsMobile.php');
	}
		
	public function mobileList()
	{	
		$postManager = new JeanForteroche\Blog\Model\PostManager();

		$episode = $postManager->getAllEpisodes();

		$lastTicket = $postManager->getLastTicket();
		$lastEpisode = $postManager->getLastEpisode();

		require('view/frontend/mobileList.php');
	}	

	public function addComment($postId, $postType, $author, $comment)
	{
		$commentManager = new JeanForteroche\Blog\Model\CommentManager();
		$newCommentDatas = $commentManager->postComment($postId, $postType, $author, $comment);

		if ($newCommentDatas === false) {
			throw new Exception('Impossible d\'ajouter le commentaire !');
		}
		else {
			header('location: index.php?ticket=' . $_GET['ticket'] . '&episode=' . $_GET['episode']);
		}
	}

	public function addPost($title, $content, $type) {
		$postManager = new JeanForteroche\Blog\Model\PostManager();
		$newPost = $postManager->newPost($title, $content, $type);
	}

	public function reportComment($commentId)
	{	
		$commentManager = new JeanForteroche\Blog\Model\CommentManager();
		$commentManager->reportBadComment($commentId);

		require('view/frontend/reportView.php');
	}

	public function confirmReport($commentId)
	{	
		$commentManager = new JeanForteroche\Blog\Model\CommentManager();
		$comment = $commentManager->getComment($_GET['comment']);
				
		require('view/frontend/reportView.php');
	}

	public function displayModeratePage()
	{
		$postManager = new JeanForteroche\Blog\Model\PostManager();
		$commentManager = new JeanForteroche\Blog\Model\CommentManager();

		require('view/backend/moderateView.php');
	}

	public function moderateComment($id, $action)
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

	public function moderatePost($id)
	{
		$postManager = new JeanForteroche\Blog\Model\PostManager();
		$postManager->deletePost($id);
	}

	public function updateArticle($id, $title, $content, $creationDate, $type)
	{
		$postManager = new JeanForteroche\Blog\Model\PostManager();
		$postManager->updatePost($id, $title, $content, $creationDate, $type);
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
		require('view/backend/articleEditor.php');
	}

	public function displayAllEpisodes() 
	{
		require('view/backend/allEpisodes.php');
	}

	public function displayAllTickets() 
	{
		require('view/backend/allTickets.php');
	}

	public function displayAllComments() 
	{
		require('view/backend/allComments.php');
	}

	public function displayAllReportedComments() 
	{
		require('view/backend/allReportedComments.php');
	}

	public function displayWriteNewArticle() 
	{
		require('view/backend/newArticle.php');
	}

	public function displayComment()
	{
		require('view/backend/commentView.php');
	}

	public function displayPost()
	{
		require('view/backend/postView.php');
	}

	public function logout()
	{
		session_destroy();
	    
	    header( "Location: index.php");
	}
}