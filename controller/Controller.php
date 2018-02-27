<?php 
require_once "model/PostManager.php";
require_once "model/CommentManager.php";
require_once "model/MemberManager.php";
require_once "model/CounterManager.php";

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
			$ticket = $postManager->getPost(htmlspecialchars($_GET['ticket']));
			$episode_ = $postManager->getPost(htmlspecialchars($_GET['episode']));//à remplacer $episode
			$previousTicket = $postManager->getPreviousPost($ticket->getPostId(), 'ticket');
			$previousEpisode = $postManager->getPreviousPost($episode_->getPostId(), 'episode');
			$nextTicket = $postManager->getNextPost(htmlspecialchars($_GET['ticket']), 'ticket');
			$nextEpisode = $postManager->getNextPost(htmlspecialchars($_GET['episode']), 'episode');
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

		require "view/frontend/homeView.php";
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
			$nextTicket = $postManager->getNextPost(htmlspecialchars($_GET['ticket']), 'ticket');
		
			$previousTicketLink = '<a class="previous-ticket-link" href="index.php?action=mobileTickets&amp;ticket='. $previousTicket->getPostId() . '&amp;episode=' . $episode_->getPostId() .'"><i class="far fa-hand-point-left fa-lg"></i></a>';
			$nextTicketLink = Null;
		}
		elseif ($_GET['ticket'] != $lastTicket->getPostId())
		{
			$ticket = $postManager->getPost(htmlspecialchars($_GET['ticket']));
			$episode_ = $postManager->getPost(htmlspecialchars($_GET['episode']));//à remplacer $episode
			$ticketComments = $commentManager->getAllComments($ticket->getPostId());
			$previousTicket = $postManager->getPreviousPost($ticket->getPostId(), 'ticket');
			$nextTicket = $postManager->getNextPost(htmlspecialchars($_GET['ticket']), 'ticket');

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
			
		require "view/frontend/ticketsMobile.php";
	}
		
	public function mobileList()
	{	
		$postManager = new JeanForteroche\Blog\Model\PostManager();

		$episode = $postManager->getAllEpisodes();

		$lastTicket = $postManager->getLastTicket();
		$lastEpisode = $postManager->getLastEpisode();

		require "view/frontend/mobileList.php";
	}	

	public function addComment($postId, $postType, $author, $comment)
	{
		$commentManager = new JeanForteroche\Blog\Model\CommentManager();
		$newCommentDatas = $commentManager->postComment($postId, $postType, $author, $comment);

		if ($newCommentDatas === false) {
			throw new Exception('Impossible d\'ajouter le commentaire !');
		}
		else {
			header('location: index.php?ticket=' . htmlspecialchars($_GET['ticket']) . '&episode=' . htmlspecialchars($_GET['episode']));
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

		require "view/frontend/reportView.php";
	}

	public function confirmReport($commentId)
	{	
		$commentManager = new JeanForteroche\Blog\Model\CommentManager();
		$comment = $commentManager->getComment(htmlspecialchars($_GET['comment']));
				
		require "view/frontend/reportView.php";
	}

	public function displayModeratePage()
	{
		$postManager = new JeanForteroche\Blog\Model\PostManager();
		$commentManager = new JeanForteroche\Blog\Model\CommentManager();

		// ATTRIBUTION DE L'ICONE
		if ($_GET['from'] == 'allEpisodes') {
			$type = 'épisode <i class="fab fa-envira"></i>';
			$episode = $postManager->getPost(htmlspecialchars($_GET['delete']));
			$element = $episode->getTitle();
		} elseif ($_GET['from'] == 'allTickets') {
			$type = 'billet <i class="fas fa-bullhorn"></i>';
			$ticket = $postManager->getPost(htmlspecialchars($_GET['delete']));
			$element = $ticket->getTitle();
		} elseif ($_GET['from'] == 'allComments') {
			$type = 'commentaire <i class="fas fa-comments"></i>';
		} elseif ($_GET['from'] == 'reportedComments') {
			$type = 'commentaire <i class="fas fa-comments"></i>';
		} elseif ($_GET['from'] == 'dashboard') {
			$type = 'commentaire <i class="fas fa-comments"></i>';
		}

		$action = $_GET['action'];
		if (isset($_GET['allow']) AND $_GET['allow'] > 0) {
			$message = '<p>Souhaitez-vous vraiment accepter le ' . $type . '?</p>';
			if ($_GET['from'] == 'dashboard') {
				$comment = $commentManager->getComment(htmlspecialchars($_GET['allow']));
				$element = $comment->getAuthor();	
				$buttons = '<a href="index.php?action=' . $action . '&amp;allow=' . htmlspecialchars($_GET['allow']) . '&amp;confirm=allow&amp;from=dashboard"><input type="button" value="Oui" /></a>
				<a href="index.php?action=dashboard"><input type="button" value="Non" /></a>';		
			} elseif ($_GET['from'] == 'reportedComments') {
				$comment = $commentManager->getComment(htmlspecialchars($_GET['allow']));
				$element = $comment->getAuthor();
				$buttons = '<a href="index.php?action=' . $action . '&amp;allow=' . htmlspecialchars($_GET['allow']) . '&amp;confirm=allow&amp;from=reportedComments&amp;page=' . htmlspecialchars($_GET['page']) . '"><input type="button" value="Oui" /></a>
				<a href="index.php?action=reportedComments&amp;page=' . htmlspecialchars($_GET['page']) . '"><input type="button" value="Non" /></a>';
			}

		} elseif (isset($_GET['delete']) AND $_GET['delete'] > 0) {
			$message = '<p>Souhaitez-vous vraiment supprimer cet élément ?</p>';
			if ($_GET['from'] == 'dashboard') {
				$comment = $commentManager->getComment(htmlspecialchars($_GET['delete']));
				$element = $comment->getAuthor();	
				$buttons = '<a href="index.php?action=' . $action . '&amp;delete=' . htmlspecialchars($_GET['delete']) . '&amp;confirm=delete&amp;from=dashboard"><input type="button" value="Oui" /></a>
				<a href="index.php?action=dashboard"><input type="button" value="Non" /></a>';
			} elseif ($_GET['from'] == 'allEpisodes') {
				$buttons = '<a href="index.php?action=' . $action . '&amp;delete=' . htmlspecialchars($_GET['delete']) . '&amp;confirm=delete&amp;from=allEpisodes&amp;page=' . htmlspecialchars($_GET['page']) . '"><input type="button" value="Oui" /></a>
				<a href="index.php?action=allEpisodes&amp;page=' . htmlspecialchars($_GET['page']) . '"><input type="button" value="Non" /></a>';
			} elseif ($_GET['from'] == 'allTickets') {
				$buttons = '<a href="index.php?action=' . $action . '&amp;delete=' . htmlspecialchars($_GET['delete']) . '&amp;confirm=delete&amp;from=allTickets&amp;page=' . htmlspecialchars($_GET['page']) . '"><input type="button" value="Oui" /></a>
				<a href="index.php?action=allTickets&amp;page=' . htmlspecialchars($_GET['page']) . '"><input type="button" value="Non" /></a>';
			} elseif ($_GET['from'] == 'allComments') {
				$comment = $commentManager->getComment(htmlspecialchars($_GET['delete']));
				$element = $comment->getAuthor();	
				$buttons = '<a href="index.php?action=' . $action . '&amp;delete=' . htmlspecialchars($_GET['delete']) . '&amp;confirm=delete&amp;from=allComments&amp;page=' . htmlspecialchars($_GET['page']) . '"><input type="button" value="Oui" /></a>
				<a href="index.php?action=allComments&amp;page=' . htmlspecialchars($_GET['page']) .'"><input type="button" value="Non" /></a>';
			} elseif ($_GET['from'] == 'reportedComments') {
				$comment = $commentManager->getComment(htmlspecialchars($_GET['delete']));
				$element = $comment->getAuthor();	
				$buttons = '<a href="index.php?action=' . $action . '&amp;delete=' . $_GET['delete'] . '&amp;confirm=delete&amp;from=reportedComments&amp;page=' . $_GET['page'] . '"><input type="button" value="Oui" /></a>
				<a href="index.php?action=reportedComments&amp;page=' . $_GET['page'] . '"><input type="button" value="Non" /></a>';
			}		
		} else {
			throw new Exception('impossible de récupérer les données de l\'élément');		
		}
	

		require "view/backend/moderateView.php";
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
		require "view/frontend/loginView.php";
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
		$commentManager = new JeanForteroche\Blog\Model\CommentManager;
		$postManager = new JeanForteroche\Blog\Model\PostManager;
		$counterManager = new JeanForteroche\Blog\Model\CounterManager;

		$lastEpisode = $postManager->getLastEpisode();
		$lastTicket = $postManager->getLastTicket();
		$lastTwoReportedComments = $commentManager->getLastTwoReportedComments();
		$lastFiveComments = $commentManager->getLastFiveComments();

		$episodeStats = $postManager->getAllEpisodes();
		$ticketStats = $postManager->getAllTickets();

		$mostCommentedEpisode = $commentManager->getMostCommentedArticle('episode');
		$mostCommentedTicket = $commentManager->getMostCommentedArticle('ticket');
		$episode = $postManager->getPost($mostCommentedEpisode);
		$ticket = $postManager->getPost($mostCommentedTicket);

		$mostReadEpisode = $counterManager->mostReadArticle('episode');
		$mostReadTicket = $counterManager->mostReadArticle('ticket');
		$episodeN1 = $postManager->getPost($mostReadEpisode);
		$ticketN1 = $postManager->getPost($mostReadTicket);

		$dayReaders = $counterManager->getReaders(0);
		$weekReaders = $counterManager->getReaders(6);
		$monthReaders = $counterManager->getReaders(30);
		$yearReaders = $counterManager->getReaders(364);
		$allReaders = $counterManager->getReaders(364*10);

		require "view/backend/dashboardView.php";
	}

	public function displayArticleWriter()
	{
	    $postManager = new  JeanForteroche\Blog\Model\PostManager();
		$episode = $postManager->getPost($_GET['edit']);
		$type = $episode->getType();

		// ATTRIBUTION DE L'ICONE
		if ($type == 'episode') {
			$type = 'ÉPISODE <i class="fab fa-envira"></i>';
		} elseif ($type == 'ticket') {
			$type = 'BILLET <i class="fas fa-bullhorn"></i>';
		}

		// CONVERSION creationDate EN datetime-local
		$originalDate = $episode->getCreationDate();
		$date = mb_strimwidth($originalDate, 10,18);
		$date = str_replace('h', ':', $date);
		$dmY = mb_strimwidth($originalDate, 10,10);
		$dmY = strtotime($dmY);
		$Ymd = date('Y-m-d', $dmY);
		$date = $Ymd . 'T' . mb_strimwidth($date, 13,2) . ':' . mb_strimwidth($date, 16,2);

		require "view/backend/articleEditor.php";
	}

	public function displayAllEpisodes() 
	{
		$postManager = new  JeanForteroche\Blog\Model\PostManager();
		$commentManager = new JeanForteroche\Blog\Model\CommentManager;
		$counterManager = new JeanForteroche\Blog\Model\CounterManager;
		
		$episodes = $postManager->getAllEpisodes();
		$pagesNumber = $postManager->paging('episode');

		$episodeStats = $postManager->getAllEpisodes();
		$ticketStats = $postManager->getAllTickets();

		$mostCommentedEpisode = $commentManager->getMostCommentedArticle('episode');
		$mostCommentedTicket = $commentManager->getMostCommentedArticle('ticket');
		$episode = $postManager->getPost($mostCommentedEpisode);
		$ticket = $postManager->getPost($mostCommentedTicket);

		$mostReadEpisode = $counterManager->mostReadArticle('episode');
		$mostReadTicket = $counterManager->mostReadArticle('ticket');
		$episodeN1 = $postManager->getPost($mostReadEpisode);
		$ticketN1 = $postManager->getPost($mostReadTicket);

		$dayReaders = $counterManager->getReaders(0);
		$weekReaders = $counterManager->getReaders(6);
		$monthReaders = $counterManager->getReaders(30);
		$yearReaders = $counterManager->getReaders(364);
		$allReaders = $counterManager->getReaders(364*10);

		require "view/backend/allEpisodes.php";
	}

	public function displayAllTickets() 
	{
		$postManager = new  JeanForteroche\Blog\Model\PostManager();
		$commentManager = new JeanForteroche\Blog\Model\CommentManager;
		$counterManager = new JeanForteroche\Blog\Model\CounterManager;

		$tickets = $postManager->getAllTickets();
		$pagesNumber = $postManager->paging('ticket');

		$episodeStats = $postManager->getAllEpisodes();
		$ticketStats = $postManager->getAllTickets();

		$mostCommentedEpisode = $commentManager->getMostCommentedArticle('episode');
		$mostCommentedTicket = $commentManager->getMostCommentedArticle('ticket');
		$episode = $postManager->getPost($mostCommentedEpisode);
		$ticket = $postManager->getPost($mostCommentedTicket);

		$mostReadEpisode = $counterManager->mostReadArticle('episode');
		$mostReadTicket = $counterManager->mostReadArticle('ticket');
		$episodeN1 = $postManager->getPost($mostReadEpisode);
		$ticketN1 = $postManager->getPost($mostReadTicket);

		$dayReaders = $counterManager->getReaders(0);
		$weekReaders = $counterManager->getReaders(6);
		$monthReaders = $counterManager->getReaders(30);
		$yearReaders = $counterManager->getReaders(364);
		$allReaders = $counterManager->getReaders(364*10);

		require "view/backend/allTickets.php";
	}

	public function displayAllComments() 
	{
		$postManager = new  JeanForteroche\Blog\Model\PostManager();
		$commentManager = new JeanForteroche\Blog\Model\CommentManager;
		$counterManager = new JeanForteroche\Blog\Model\CounterManager;

		$comments = $commentManager->getAllUnsortedComments();
		$pagesNumber = $commentManager->paging('withReported');

		$episodeStats = $postManager->getAllEpisodes();
		$ticketStats = $postManager->getAllTickets();

		$mostCommentedEpisode = $commentManager->getMostCommentedArticle('episode');
		$mostCommentedTicket = $commentManager->getMostCommentedArticle('ticket');
		$episode = $postManager->getPost($mostCommentedEpisode);
		$ticket = $postManager->getPost($mostCommentedTicket);

		$mostReadEpisode = $counterManager->mostReadArticle('episode');
		$mostReadTicket = $counterManager->mostReadArticle('ticket');
		$episodeN1 = $postManager->getPost($mostReadEpisode);
		$ticketN1 = $postManager->getPost($mostReadTicket);

		$dayReaders = $counterManager->getReaders(0);
		$weekReaders = $counterManager->getReaders(6);
		$monthReaders = $counterManager->getReaders(30);
		$yearReaders = $counterManager->getReaders(364);
		$allReaders = $counterManager->getReaders(364*10);

		require "view/backend/allComments.php";
	}

	public function displayAllReportedComments() 
	{
		$postManager = new  JeanForteroche\Blog\Model\PostManager();
		$commentManager = new JeanForteroche\Blog\Model\CommentManager;
		$counterManager = new JeanForteroche\Blog\Model\CounterManager;

		$reportedComments = $commentManager->getAllReportedComments();
		$reported = 1;
		$pagesNumber = $commentManager->paging($reported);

		$episodeStats = $postManager->getAllEpisodes();
		$ticketStats = $postManager->getAllTickets();

		$mostCommentedEpisode = $commentManager->getMostCommentedArticle('episode');
		$mostCommentedTicket = $commentManager->getMostCommentedArticle('ticket');
		$episode = $postManager->getPost($mostCommentedEpisode);
		$ticket = $postManager->getPost($mostCommentedTicket);

		$mostReadEpisode = $counterManager->mostReadArticle('episode');
		$mostReadTicket = $counterManager->mostReadArticle('ticket');
		$episodeN1 = $postManager->getPost($mostReadEpisode);
		$ticketN1 = $postManager->getPost($mostReadTicket);

		$dayReaders = $counterManager->getReaders(0);
		$weekReaders = $counterManager->getReaders(6);
		$monthReaders = $counterManager->getReaders(30);
		$yearReaders = $counterManager->getReaders(364);
		$allReaders = $counterManager->getReaders(364*10);

		require "view/backend/allReportedComments.php";
	}

	public function displayWriteNewArticle() 
	{
		$postManager = new  JeanForteroche\Blog\Model\PostManager();
		$commentManager = new JeanForteroche\Blog\Model\CommentManager;
		$counterManager = new JeanForteroche\Blog\Model\CounterManager;

		$episodeStats = $postManager->getAllEpisodes();
		$ticketStats = $postManager->getAllTickets();

		$mostCommentedEpisode = $commentManager->getMostCommentedArticle('episode');
		$mostCommentedTicket = $commentManager->getMostCommentedArticle('ticket');
		$episode = $postManager->getPost($mostCommentedEpisode);
		$ticket = $postManager->getPost($mostCommentedTicket);

		$mostReadEpisode = $counterManager->mostReadArticle('episode');
		$mostReadTicket = $counterManager->mostReadArticle('ticket');
		$episodeN1 = $postManager->getPost($mostReadEpisode);
		$ticketN1 = $postManager->getPost($mostReadTicket);

		$dayReaders = $counterManager->getReaders(0);
		$weekReaders = $counterManager->getReaders(6);
		$monthReaders = $counterManager->getReaders(30);
		$yearReaders = $counterManager->getReaders(364);
		$allReaders = $counterManager->getReaders(364*10);

		if ($_GET['action'] == 'episode') {
			$type = 'NOUVEL ÉPISODE <i class="fab fa-envira"></i>';
		} elseif ($_GET['action'] == 'ticket') {
			$type = 'NOUVEAU BILLET <i class="fas fa-bullhorn"></i>';
		}

		require "view/backend/newArticle.php";
	}

	public function displayComment()
	{
		$commentManager = new JeanForteroche\Blog\Model\CommentManager();
		$postManager = new JeanForteroche\Blog\Model\PostManager();
		$comment = $commentManager->getComment($_GET['see']);
		$postId = $comment->getPostId();
		$post = $postManager->getPost($postId);

		// ATTRIBUTION DE L'ICONE
		if ($post->getType() == 'episode') {
			$type = '<i class="fab fa-envira"></i>';
		} elseif ($post->getType() == 'ticket') {
			$type = '<i class="fas fa-bullhorn"></i>';
		}

		require "view/backend/commentView.php";
	}

	public function displayPost()
	{
		$postManager = new JeanForteroche\Blog\Model\PostManager();
		// CHOIX DE L'ACTION
		if (isset($_GET['see'])) {
			$post = $postManager->getPost($_GET['see']);
			$type = $post->getType();
		} else {
			$post = $postManager->getPost($_GET['update']);
			$type = $post->getType();
		}
		// ATTRIBUTION DE L'ICONE
		if ($type == 'episode') {
			$type = ' DE L\' ÉPISODE <i class="fab fa-envira"></i>';
		} elseif ($type == 'ticket') {
			$type = ' DU BILLET <i class="fas fa-bullhorn"></i>';
		} 

		require "view/backend/postView.php";
	}

	public function logout()
	{
		session_destroy();
	    
	    header("Location: index.php");
	}
}