<?php

session_start();

require_once('controller/Controller.php');
$controller = new Controller;

try {
	if (isset($_GET['action'])) {
			if ($_GET['action'] == 'home') {
				$controller->home();
			}
			elseif ($_GET['action'] == 'post') {
				if (isset($_GET['id']) AND $_GET['id'] > 0) {
					$controller->post();
				}
				else {
					throw new Exception('aucun identifiant de billet envoyé');
				}
			}
			elseif ($_GET['action'] == 'addComment') {
	        	if (isset($_GET['ticket'], $_GET['episode']) AND $_GET['ticket'] > 0 AND $_GET['episode'] > 0) {
	            	if (!empty($_POST['author']) AND !empty($_POST['comment'])) {
	                	$controller->addComment($_GET['post'], $_GET['type'], $_POST['author'], $_POST['comment']);
	            	}
	            	else {
	                	throw new Exception('tous les champs ne sont pas remplis !');
	            	}
	        	}
	        	else {
	            	throw new Exception('aucun identifiant de billet envoyé');
	        	}
	    	}
	    	elseif ($_GET['action'] == 'report' ) {
	    		if (!isset($_GET['reported'])) {
	    			$controller->confirmReport($_GET['comment']);
	    		}
	    		elseif (isset($_GET['reported']) AND $_GET['reported'] > 0) {
	    			$controller->reportComment($_GET['reported']);
	    		}
	    		else {
	    			throw new Exception('impossible de signaler ce commentaire');
	    		}
	    	}
	    	elseif ($_GET['action'] == 'login' ) {
	    		if (isset($_GET['action']) AND !isset($_SESSION['email']) AND !isset($_SESSION['password'])) {
	    			$controller->loginPage();
	    		}
	    		elseif (isset($_SESSION['email']) AND isset($_SESSION['password'])) {
	    			$controller->displayDashboard();
	    		}
	    		else {
	    			throw new Exception('erreur d\'accès à la page de connexion');
	    		}
	    	}
	    	elseif ($_GET['action'] == 'loginCheck' ) {
	    		if (isset($_POST['email']) AND isset($_POST['password']) OR !isset($_SESSION['email']) AND !isset($_SESSION['password']))
	    		{
	    			$controller->loginCheck($_POST['email'], $_POST['password']);
	    		}
	    		elseif (isset($_SESSION['email']) AND isset($_SESSION['password']))
	    		{
	    			$controller->displayDashboard();
	    		}
	    		else {
	    			throw new Exception('erreur d\'accès à la page de connexion');
	    		}
	    	}
	    	elseif ($_GET['action'] == 'dashboard') {
	    		if (isset($_GET['action']) AND isset($_SESSION['email']) AND isset($_SESSION['password'])) {
	    			$controller->displayDashboard();	    			   	   		
	    		}
	    		else {
	    			throw new Exception('impossible de charger l\'espace membre');
	    		}
	    	}
	    	elseif ($_GET['action'] == 'allEpisodes') {
	    		if (isset($_GET['action']) AND isset($_SESSION['email']) AND isset($_SESSION['password'])) {
	    			$controller->displayAllEpisodes();
	    			if (isset($_GET['see'])) {
	    				$controller->displayPost();
	    			}
	    			elseif (isset($_GET['edit'])) {
		    			$controller->displayArticleWriter();
		    		}
		    		elseif (isset($_GET['update'])) {
		    			$controller->updateArticle($_GET['update'], $_POST['title'], $_POST['content'], $_POST['creationDate'], $_GET['type']);
		    			$controller->displayPost();
		    		}
	    		}
	    		else {
	    			throw new Exception('impossible de charger la liste des épisodes');
	    		}
	    	}
	    	elseif ($_GET['action'] == 'allTickets') {
	    		if (isset($_GET['action']) AND isset($_SESSION['email']) AND isset($_SESSION['password'])) {
	    			$controller->displayAllTickets();
	    			if (isset($_GET['see'])) {
	    				$controller->displayPost();
	    			}
	    			elseif (isset($_GET['edit'])) {
		    			$controller->displayArticleWriter();
		    		}
		    		elseif (isset($_GET['update'])) {
		    			$controller->updateArticle($_GET['update'], $_POST['title'], $_POST['content'], $_POST['creationDate'], $_GET['type']);
		    			$controller->displayPost();
		    		}

	    		}
	    		else {
	    			throw new Exception('impossible de charger la liste des billets');
	    		}
	    	}
	    	elseif ($_GET['action'] == 'allComments') {
	    		if (isset($_GET['action']) AND isset($_SESSION['email']) AND isset($_SESSION['password'])) {
	    			$controller->displayAllComments();
	    			if (isset($_GET['see'])) {
	    				$controller->displayComment();
	    			}
	    		}
	    		else {
	    			throw new Exception('impossible de charger la liste des commentaires');
	    		}
	    	}
	    	elseif ($_GET['action'] == 'reportedComments') {
	    		if (isset($_GET['action']) AND isset($_SESSION['email']) AND isset($_SESSION['password'])) {
	    			$controller->displayAllReportedComments();
	    			if (isset($_GET['see'])) {
	    				$controller->displayComment();
	    			}
	    		}
	    		else {
	    			throw new Exception('impossible de charger la liste des commentaires');
	    		}
	    	}
	    	elseif ($_GET['action'] == 'episode' OR $_GET['action'] == 'ticket') {
	    		if (isset($_GET['action']) AND isset($_SESSION['email']) AND isset($_SESSION['password'])) {
	    			$controller->displayWriteNewArticle();
	    			if (isset($_GET['posted']) AND isset($_POST['title']) AND isset($_POST['content'])) {
	    				$controller->addPost($_POST['title'], $_POST['content'], $_GET['posted']);
	    				echo 'nouvel article publié';			
	    			}
	    		} 	    		
	    		else {
	    			throw new Exception('impossible d\' enregisterer l\'article');
	    		}
	    	}
	    	elseif ($_GET['action'] == 'logout') {
	    		if (isset($_GET['action']) AND isset($_SESSION['email']) AND isset($_SESSION['password'])) {
	    			$controller->logout();
	    		}
	    		else {
	    			throw new Exception('il y a eu un problème lors de la déconnection...');
	    		}
	    	}
	    	elseif ($_GET['action'] == 'moderate') {
	    		if ((isset($_GET['allow']) AND !isset($_GET['confirm'])) OR (isset($_GET['delete']) AND !isset($_GET['confirm']))) {
	    			$controller->displayModeratePage();
	    		}


	    		// CONFIRMER LA CONSERVATION DU COMMENTAIRE
	    		elseif (isset($_GET['confirm']) AND $_GET['confirm'] == 'allow') {
	    			$controller->moderateComment($_GET['allow'], 'allow');
	    			if ($_GET['from'] == 'dashboard') {
	    				header('location: index.php?action=dashboard');
	    			} 
	    			elseif ($_GET['from'] == 'allComments') {
	    				header('location: index.php?action=allComments');
	    			}
	    			elseif ($_GET['from'] == 'reportedComments') {
	    				header('location: index.php?action=reportedComments');
	    			}
	    		}



	    		// CONFIRMER LA SUPPRESSION DE LA PUBLICATION
	    		elseif (isset($_GET['confirm']) AND $_GET['confirm'] == 'delete') {

					// SUPPRESSION : EPISODE OU BILLET
	    			if (isset($_GET['from']) AND  $_GET['from'] == 'allEpisodes') 
	    			{	
	    				$controller->moderatePost($_GET['delete']);
	    				header('location: index.php?action=allEpisodes');
	    			}
	    			elseif (isset($_GET['from']) AND  $_GET['from'] == 'allTickets')
	    			{
	    				$controller->moderatePost($_GET['delete']);
	    				header('location: index.php?action=allTickets');
	    			}

	    			// SUPPRESSION : COMMENTAIRE
	    			elseif (isset($_GET['from']) AND ($_GET['from'] == 'dashboard'))
	    			{
		    			$controller->moderateComment($_GET['delete'], 'delete');
		    			header('location: index.php?action=dashboard');
		    		}
		    		elseif (isset($_GET['from']) AND ($_GET['from'] == 'allComments'))
	    			{
		    			$controller->moderateComment($_GET['delete'], 'delete');
		    			header('location: index.php?action=allComments');
		    		}
		    		elseif (isset($_GET['from']) AND ($_GET['from'] == 'reportedComments'))
	    			{
		    			$controller->moderateComment($_GET['delete'], 'delete');
		    			header('location: index.php?action=reportedComments');
		    		}
		    		else
		    		{
		    			throw new Exception('c\'est là que ça plante');
		    				
		    		}
		    	}
	    	}
	    		
	    	
	  }
	
	else {
		$controller->home();
	}
}
catch (Exception $e) {
	$errorMessage = 'Message : ' . $e->getMessage();
	require('view/frontend/404.php');
}