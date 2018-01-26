<?php
require_once('controller/frontend.php');
$controller = new Controller;

try {
	if (isset($_GET['action'])) {
			if ($_GET['action'] == 'listPosts') {
				$controllerCall = $controller->listPosts();
			}
			elseif ($_GET['action'] == 'post') {
				if (isset($_GET['id']) && $_GET['id'] > 0) {
					$controllerCall = $controller->post();
				}
				else {
					throw new Exception('aucun identifiant de billet envoyé');
				}
			}
			elseif ($_GET['action'] == 'addComment') {
	        	if (isset($_GET['id']) && $_GET['id'] > 0) {
	            	if (!empty($_POST['author']) && !empty($_POST['comment'])) {
	                $controllerCall = $controller->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
	            	}
	            else {
	                throw new Exception('tous les champs ne sont pas remplis !');
	            }
	        }
	        else {
	            throw new Exception('aucun identifiant de billet envoyé');
	        }
	    }
	}
	else {
		$controllerCall = $controller->listPosts();
	}
}
catch (Exception $e) {
	$errorMessage = 'Message : ' . $e->getMessage();
	require('view/frontend/404.php');
}