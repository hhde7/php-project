<?php

session_start();

require_once('controller/Controller.php');
$controller = new Controller;

try {
	if (isset($_GET['action'])) {
			if ($_GET['action'] == 'listPosts') {
				$controller->listPosts();
			}
			elseif ($_GET['action'] == 'post') {
				if (isset($_GET['id']) && $_GET['id'] > 0) {
					$controller->post();
				}
				else {
					throw new Exception('aucun identifiant de billet envoyé');
				}
			}
			elseif ($_GET['action'] == 'addComment') {
	        	if (isset($_GET['id']) && $_GET['id'] > 0) {
	            	if (!empty($_POST['author']) && !empty($_POST['comment'])) {
	                	$controller->addComment($_GET['id'], $_GET['type'], $_POST['author'], $_POST['comment']);
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
	    		elseif (isset($_GET['reported']) && $_GET['reported'] > 0) {
	    			$controller->reportComment($_GET['reported']);
	    		}
	    		else {
	    			throw new Exception('impossible de signaler ce commentaire');
	    		}
	    	}
	    	elseif ($_GET['action'] == 'login' ) {
	    		if (isset($_GET['action'])) {
	    			$controller->loginPage();
	    		}
	    		else {
	    			throw new Exception('erreur d\'accès à la page de connexion');
	    		}
	    	}
	    	elseif ($_GET['action'] == 'loginCheck' ) {
	    		if (isset($_POST['email']) && isset($_POST['password'])) {
	    			$controller->loginCheck($_POST['email'], $_POST['password']);
	    		}
	    		else {
	    			throw new Exception('erreur d\'accès à la page de connexion');
	    		}
	    	}
	    	elseif ($_GET['action'] == 'dashboard' ) {
	    		if (isset($_GET['action']) && isset($_SESSION['email']) && isset($_SESSION['password'])) {
	    			$controller->displayDashboard();
	    			if (isset($_GET['delete'])) {
	    				$controller->moderateComments($_GET['delete'], 'delete');
	    			}
	    			elseif (isset($_GET['allow'])) {
	    				$controller->moderateComments($_GET['allow'], 'allow');
	    			}   		
	    		}
	    		else {
	    			throw new Exception('impossible de charger l\'espace membre');
	    		}
	    	}
	}
	else {
		$controller->listPosts();
	}
}
catch (Exception $e) {
	$errorMessage = 'Message : ' . $e->getMessage();
	require('view/frontend/404.php');
}