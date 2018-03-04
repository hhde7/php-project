<?php
namespace JeanForteroche\Blog\Controller;

require_once "model/PostManager.php";
require_once "model/CommentManager.php";
require_once "model/MemberManager.php";
require_once "model/CounterManager.php";

class Controller
{
    public function home() // PERMET LA NAVIGATION SIMULTANNÉE ET INDÉPENDANTE ENTRE LES ÉPISODES ET LES BILLETS
    {
        $postManager = new \JeanForteroche\Blog\Model\PostManager();
        $commentManager = new \JeanForteroche\Blog\Model\CommentManager();
        $counterManager = new \JeanForteroche\Blog\Model\CounterManager();

        $ip = $_SERVER['REMOTE_ADDR'];
        $episodes = $postManager->getAllEpisodes();

        $firstTicket = $postManager->getFirstTicket();
        $firstEpisode = $postManager->getFirstEpisode();
        $lastTicket = $postManager->getLastTicket();
        $lastEpisode = $postManager->getLastEpisode();

        if (isset($_GET['ticket'], $_GET['episode'])) {
            $ticketCheck = $postManager->getPost(htmlspecialchars($_GET['ticket']));
            $episodeCheck = $postManager->getPost(htmlspecialchars($_GET['episode']));
        }

        // SI PAGE DE GARDE OU, DERNIER TICKET ET DERNIER EPISODE
        if (!isset($_GET['ticket'], $_GET['episode']) or $_GET['ticket'] == $lastTicket->getPostId() and $_GET['episode'] == $lastEpisode->getPostId()
            or $ticketCheck->getPostId() === null or $episodeCheck->getPostId() === null or $ticketCheck->getType() != 'ticket' or $episodeCheck->getType() != 'episode') {
            $ticket = $postManager->getLastTicket();
            $episode = $postManager->getLastEpisode();
            $previousTicket = $postManager->getPreviousPost($ticket->getPostId(), 'ticket');
            $previousEpisode = $postManager->getPreviousPost($episode->getPostId(), 'episode');
            $ticketComments = $commentManager->getAllComments($ticket->getPostId());
            $episodeComments = $commentManager->getAllComments($episode->getPostId());

            $previousTicketLink = '<a class="previous-ticket-link" href="index.php?ticket='. $previousTicket->getPostId() . '&amp;episode=' . $episode->getPostId() .'"><i class="far fa-hand-point-left fa-lg"></i></a>';
            $nextTicketLink = null;

            $previousEpisodeLink = '<a class="previous-episode-link" href="index.php?ticket='. $ticket->getPostId() .'&amp;episode='. $previousEpisode->getPostId() .'"><i class="far fa-hand-point-left fa-lg"></i></a>';
            $nextEpisodeLink = null;
        } elseif (isset($_GET['ticket']) and isset($_GET['episode'])) {
            $ticket = $postManager->getPost(htmlspecialchars($_GET['ticket']));
            $episode = $postManager->getPost(htmlspecialchars($_GET['episode']));
            $previousTicket = $postManager->getPreviousPost($ticket->getPostId(), 'ticket');
            $previousEpisode = $postManager->getPreviousPost($episode->getPostId(), 'episode');
            $nextTicket = $postManager->getNextPost(htmlspecialchars($_GET['ticket']), 'ticket');
            $nextEpisode = $postManager->getNextPost(htmlspecialchars($_GET['episode']), 'episode');
            $ticketComments = $commentManager->getAllComments($ticket->getPostId());
            $episodeComments = $commentManager->getAllComments($episode->getPostId());

            // SI PREMIER TICKET ET PREMIER EPISODE
            if ($_GET['ticket'] == $firstTicket->getPostId() and $_GET['episode'] == $firstEpisode->getPostId()) {
                $previousTicketLink = null;
                $nextTicketLink = '<a class="next-ticket-link" href="index.php?ticket='. $nextTicket->getPostId() . '&amp;episode=' . $episode->getPostId() .'"><i class="far fa-hand-point-right fa-lg"></i></a>';

                $previousEpisodeLink = null;
                $nextEpisodeLink = '<a class="next-episode-link" href="index.php?ticket='. $ticket->getPostId() .'&amp;episode='. $nextEpisode->getPostId() .'"><i class="far fa-hand-point-right fa-lg"></i></a>';
            }
            // SI PREMIER TICKET, ET UN EPISODE != DU DERNIER
            elseif ($_GET['ticket'] == $firstTicket->getPostId() and $_GET['episode'] != $lastEpisode->getPostId()) {
                $previousTicketLink = null;
                $nextTicketLink = '<a class="next-ticket-link" href="index.php?ticket='. $nextTicket->getPostId() . '&amp;episode=' . $episode->getPostId() .'"><i class="far fa-hand-point-right fa-lg"></i></a>';

                $previousEpisodeLink = '<a class="previous-episode-link" href="index.php?ticket='. $ticket->getPostId() .'&amp;episode='. $previousEpisode->getPostId() .'"><i class="far fa-hand-point-left fa-lg"></i></a>';
                $nextEpisodeLink = '<a class="next-episode-link" href="index.php?ticket='. $ticket->getPostId() .'&amp;episode='. $nextEpisode->getPostId() .'"><i class="far fa-hand-point-right fa-lg"></i></a>';
            }
            // SI PREMIER TICKET ET DERNIER EPISODE
            elseif ($_GET['ticket'] == $firstTicket->getPostId() and $_GET['episode'] == $lastEpisode->getPostId()) {
                $previousTicketLink = null;
                $nextTicketLink = '<a class="next-ticket-link" href="index.php?ticket='. $nextTicket->getPostId() . '&amp;episode=' . $episode->getPostId() .'"><i class="far fa-hand-point-right fa-lg"></i></a>';

                $previousEpisodeLink = '<a class="previous-episode-link" href="index.php?ticket='. $ticket->getPostId() .'&amp;episode='. $previousEpisode->getPostId() .'"><i class="far fa-hand-point-left fa-lg"></i></a>';
                $nextEpisodeLink = null;
            }
            // SI UN TICKET != PREMIER ET DERNIER EPISODE
            elseif ($_GET['ticket'] != $firstTicket->getPostId() and $_GET['episode'] == $lastEpisode->getPostId()) {
                $previousTicketLink = '<a class="previous-ticket-link" href="index.php?ticket='. $previousTicket->getPostId() . '&amp;episode=' . $episode->getPostId() .'"><i class="far fa-hand-point-left fa-lg"></i></a>';
                $nextTicketLink = '<a class="next-ticket-link" href="index.php?ticket='. $nextTicket->getPostId() . '&amp;episode=' . $episode->getPostId() .'"><i class="far fa-hand-point-right fa-lg"></i></a>';

                $previousEpisodeLink = '<a class="previous-episode-link" href="index.php?ticket='. $ticket->getPostId() .'&amp;episode='. $previousEpisode->getPostId() .'"><i class="far fa-hand-point-left fa-lg"></i></a>';
                $nextEpisodeLink = null;
            }
            // SI UN TICKET != (PREMIER & DERNIER) ET EPISODE != (PREMIER & DERNIER)
            elseif ($_GET['ticket'] != $firstTicket->getPostId() and
                    $_GET['ticket'] != $lastTicket->getPostId() and
                    $_GET['episode'] != $firstEpisode->getPostId() and
                    $_GET['episode'] != $lastEpisode->getPostId()) {
                $previousTicketLink = '<a class="previous-ticket-link" href="index.php?ticket='. $previousTicket->getPostId() . '&amp;episode=' . $episode->getPostId() .'"><i class="far fa-hand-point-left fa-lg"></i></a>';
                $nextTicketLink = '<a class="next-ticket-link" href="index.php?ticket='. $nextTicket->getPostId() . '&amp;episode=' . $episode->getPostId() .'"><i class="far fa-hand-point-right fa-lg"></i></a>';

                $previousEpisodeLink = '<a class="previous-episode-link" href="index.php?ticket='. $ticket->getPostId() .'&amp;episode='. $previousEpisode->getPostId() .'"><i class="far fa-hand-point-left fa-lg"></i></a>';
                $nextEpisodeLink = '<a class="next-episode-link" href="index.php?ticket='. $ticket->getPostId() .'&amp;episode='. $nextEpisode->getPostId() .'"><i class="far fa-hand-point-right fa-lg"></i></a>';
            }
            // SI DERNIER TICKET ET PREMIER EPISODE
            elseif ($_GET['ticket'] == $lastTicket->getPostId() and $_GET['episode'] == $firstEpisode->getPostId()) {
                $previousTicketLink = '<a class="previous-ticket-link" href="index.php?ticket='. $previousTicket->getPostId() . '&amp;episode=' . $episode->getPostId() .'"><i class="far fa-hand-point-left fa-lg"></i></a>';
                $nextTicketLink = null;

                $previousEpisodeLink = null;
                $nextEpisodeLink = '<a class="next-episode-link" href="index.php?ticket='. $ticket->getPostId() .'&amp;episode='. $nextEpisode->getPostId() .'"><i class="far fa-hand-point-right fa-lg"></i></a>';
            }
            // SI DERNIER TICKET ET UN EPISODE != (PERMIER & DERNIER)
            elseif ($_GET['ticket'] == $lastTicket->getPostId() and
                    $_GET['episode'] != $firstEpisode->getPostId() and
                    $_GET['episode'] != $lastEpisode->getPostId()) {
                $previousTicketLink = '<a class="previous-ticket-link" href="index.php?ticket='. $previousTicket->getPostId() . '&amp;episode=' . $episode->getPostId() .'"><i class="far fa-hand-point-left fa-lg"></i></a>';
                $nextTicketLink = null;

                $previousEpisodeLink = '<a class="previous-episode-link" href="index.php?ticket='. $ticket->getPostId() .'&amp;episode='. $previousEpisode->getPostId() .'"><i class="far fa-hand-point-left fa-lg"></i></a>';
                $nextEpisodeLink = '<a class="next-episode-link" href="index.php?ticket='. $ticket->getPostId() .'&amp;episode='. $nextEpisode->getPostId() .'"><i class="far fa-hand-point-right fa-lg"></i></a>';
            }
            // SI TICKET != (PERMIER & DERNIER) ET DERNIER EPISODE
            elseif ($_GET['ticket'] != $firstTicket->getPostId() and
                    $_GET['ticket'] != $lastTicket->getPostId() and
                    $_GET['episode'] != $lastEpisode->getPostId()) {
                $previousTicketLink = '<a class="previous-ticket-link" href="index.php?ticket='. $previousTicket->getPostId() . '&amp;episode=' . $episode->getPostId() .'"><i class="far fa-hand-point-left fa-lg"></i></a>';
                $nextTicketLink = '<a class="next-ticket-link" href="index.php?ticket='. $nextTicket->getPostId() . '&amp;episode=' . $episode->getPostId() .'"><i class="far fa-hand-point-right fa-lg"></i></a>';

                $previousEpisodeLink = null;
                $nextEpisodeLink = '<a class="next-episode-link" href="index.php?ticket='. $ticket->getPostId() .'&amp;episode='. $nextEpisode->getPostId() .'"><i class="far fa-hand-point-right fa-lg"></i></a>';
            }
        } else {
            throw new Exception("Erreur de navigation");
        }

        require "view/frontend/homeView.php";
    }

    public function ticketsMobile()
    {
        $postManager = new \JeanForteroche\Blog\Model\PostManager();
        $commentManager = new \JeanForteroche\Blog\Model\CommentManager();

        $firstTicket = $postManager->getFirstTicket();
        $firstEpisode = $postManager->getFirstEpisode();
        $lastTicket = $postManager->getLastTicket();
        $lastEpisode = $postManager->getLastEpisode();

        $ticketCheck = $postManager->getPost(htmlspecialchars($_GET['ticket']));
        $episodeCheck = $postManager->getPost(htmlspecialchars($_GET['episode']));


        if ($_GET['ticket'] == $lastTicket->getPostId() or $ticketCheck->getPostId() === null
                or $episodeCheck->getPostId() === null or $ticketCheck->getType() != 'ticket' or $episodeCheck->getType() != 'episode') {
            $ticket = $postManager->getLastTicket();
            $episode = $postManager->getLastEpisode();
            $ticketComments = $commentManager->getAllComments($lastTicket->getPostId());
            $previousTicket = $postManager->getPreviousPost($ticket->getPostId(), 'ticket');
            $nextTicket = $postManager->getNextPost(htmlspecialchars($_GET['ticket']), 'ticket');

            $previousTicketLink = '<a class="previous-ticket-link" href="index.php?action=mobileTickets&amp;ticket='. $previousTicket->getPostId() . '&amp;episode=' . $episode->getPostId() .'"><i class="far fa-hand-point-left fa-lg"></i></a>';
            $nextTicketLink = null;
        } elseif ($_GET['ticket'] != $lastTicket->getPostId()) {
            $ticket = $postManager->getPost(htmlspecialchars($_GET['ticket']));
            $episode = $postManager->getPost(htmlspecialchars($_GET['episode']));
            $ticketComments = $commentManager->getAllComments($ticket->getPostId());
            $previousTicket = $postManager->getPreviousPost($ticket->getPostId(), 'ticket');
            $nextTicket = $postManager->getNextPost(htmlspecialchars($_GET['ticket']), 'ticket');

            if (isset($_GET['ticket']) and $_GET['ticket'] == $firstTicket->getPostId()) {
                $previousTicketLink = null;
                $nextTicketLink = '<a class="next-ticket-link" href="index.php?action=mobileTickets&amp;ticket='. $nextTicket->getPostId() . '&amp;episode=' . $episode->getPostId() .'"><i class="far fa-hand-point-right fa-lg"></i></a>';
            } elseif (isset($_GET['ticket']) and $_GET['ticket'] != $lastTicket->getPostId() and $_GET['ticket'] != $firstTicket->getPostId()) {
                $previousTicketLink = '<a class="previous-ticket-link" href="index.php?action=mobileTickets&amp;ticket='. $previousTicket->getPostId() . '&amp;episode=' . $episode->getPostId() .'"><i class="far fa-hand-point-left fa-lg"></i></a>';
                $nextTicketLink = '<a class="next-ticket-link" href="index.php?action=mobileTickets&amp;ticket='. $nextTicket->getPostId() . '&amp;episode=' . $episode->getPostId() .'"><i class="far fa-hand-point-right fa-lg"></i></a>';
            }
        }

        require "view/frontend/ticketsMobile.php";
    }

    public function mobileList()
    {
        $postManager = new \JeanForteroche\Blog\Model\PostManager();

        $episodes = $postManager->getAllEpisodes();

        $lastTicket = $postManager->getLastTicket();
        $lastEpisode = $postManager->getLastEpisode();

        require "view/frontend/mobileList.php";
    }

    public function addComment($postId, $postType, $author, $comment)
    {
        $commentManager = new \JeanForteroche\Blog\Model\CommentManager();

        $newCommentDatas = $commentManager->postComment($postId, $postType, $author, $comment);

        if ($newCommentDatas === false) {
            throw new Exception('Impossible d\'ajouter le commentaire !');
        } else {
            header('location: index.php?ticket=' . htmlspecialchars($_GET['ticket']) . '&episode=' . htmlspecialchars($_GET['episode']));
        }
    }

    public function addPost($title, $content, $type)
    {
        $postManager = new \JeanForteroche\Blog\Model\PostManager();
        $newPost = $postManager->newPost($title, $content, $type);
    }

    public function confirmReport($commentId)
    {
        $postManager = new \JeanForteroche\Blog\Model\PostManager();
        $commentManager = new \JeanForteroche\Blog\Model\CommentManager();

        $postIdCheck = $postManager->getPost(htmlspecialchars($_GET['id']));
        $commentIdCheck = $commentManager->getComment(htmlspecialchars($_GET['comment']));

        if (isset($_GET['ticket'], $_GET['episode'])) {
            if ($commentIdCheck->getPostId() === $postIdCheck->getPostId()) {
                $ticketCheck = $postManager->getPost(htmlspecialchars($_GET['ticket']));
                $episodeCheck = $postManager->getPost(htmlspecialchars($_GET['episode']));

                if ($commentIdCheck->getPostId() !== null and $postIdCheck->getPostId() !== null
                         and $ticketCheck->getPostId() !== null and $episodeCheck->getPostId() !== null) {
                    $comment = $commentManager->getComment(htmlspecialchars($_GET['comment']));

                    require "view/frontend/reportView.php";
                } else {
                    throw new Exception("Des informations manquent pour effectuer cette opération");
                }
            } else {
                throw new Exception("Le commentaire ne correspond pas à l'article");
            }
        } else {
            throw new Exception("Le commentaire à signaler n'existe pas");
        }
    }

    public function reportComment($commentId)
    {
        $postManager = new \JeanForteroche\Blog\Model\PostManager();
        $commentManager = new \JeanForteroche\Blog\Model\CommentManager();

        $postIdCheck = $postManager->getPost(htmlspecialchars($_GET['id']));
        $reportedCommentIdCheck = $commentManager->getComment(htmlspecialchars($_GET['reported']));

        if (isset($_GET['ticket'], $_GET['episode'])) {
            if ($reportedCommentIdCheck->getPostId() === $postIdCheck->getPostId()) {
                $ticketCheck = $postManager->getPost(htmlspecialchars($_GET['ticket']));
                $episodeCheck = $postManager->getPost(htmlspecialchars($_GET['episode']));

                if ($reportedCommentIdCheck->getPostId() !== null and $postIdCheck->getPostId() !== null
                         and $ticketCheck->getPostId() !== null and $episodeCheck->getPostId() !== null
                         and ($ticketCheck->getPostId() === $postIdCheck->getPostId()
                         or $episodeCheck->getPostId() === $postIdCheck->getPostId())) {
                    $commentManager->reportBadComment($commentId);

                    require "view/frontend/reportView.php";
                } else {
                    throw new Exception("Des informations manquent pour effectuer cette opération");
                }
            } else {
                throw new Exception("Le commentaire ne correspond pas à l'article");
            }
        } else {
            throw new Exception("Le commentaire à signaler n'existe pas");
        }
    }

    public function displayModeratePage()
    {
        $postManager = new \JeanForteroche\Blog\Model\PostManager();
        $commentManager = new \JeanForteroche\Blog\Model\CommentManager();

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
        if (isset($_GET['allow']) and $_GET['allow'] > 0) {
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
        } elseif (isset($_GET['delete']) and $_GET['delete'] > 0) {
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
                $buttons = '<a href="index.php?action=' . $action . '&amp;delete=' . htmlspecialchars($_GET['delete']) . '&amp;confirm=delete&amp;from=reportedComments&amp;page=' . htmlspecialchars($_GET['page']) . '"><input type="button" value="Oui" /></a>
				<a href="index.php?action=reportedComments&amp;page=' . htmlspecialchars($_GET['page']) . '"><input type="button" value="Non" /></a>';
            }
        } else {
            throw new Exception('impossible de récupérer les données de l\'élément');
        }


        require "view/backend/moderateView.php";
    }

    public function moderateComment($id, $action)
    {
        $commentManager = new \JeanForteroche\Blog\Model\CommentManager();

        if (isset($action) and $action == 'delete') {
            $commentManager->deleteComment($id);
        } elseif (isset($action) and $action == 'allow') {
            $commentManager->allowComment($id);
        } else {
            throw new Exception('impossible de modérer ce commentaire');
        }
    }

    public function moderatePost($id)
    {
        $postManager = new \JeanForteroche\Blog\Model\PostManager();

        $postManager->deletePost($id);
    }

    public function updateArticle($id, $title, $content, $creationDate, $type)
    {
        $postManager = new \JeanForteroche\Blog\Model\PostManager();

        $postManager->updatePost($id, $title, $content, $creationDate, $type);
    }

    public function loginPage()
    {
        require "view/frontend/loginView.php";
    }

    public function loginCheck($email, $password)
    {
        $memberManager = new \JeanForteroche\Blog\Model\MemberManager();
        $member = $memberManager->memberCheck($email, $password);

        if ($member->getEmail() !== $email or $member->getPassword() !== $password) {
            throw new Exception('Les identifiants sont incorrects');
        } else {
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            header('location: index.php?action=dashboard');
        }
    }

    public function displayDashboard()
    {
        $commentManager = new \JeanForteroche\Blog\Model\CommentManager;
        $postManager = new \JeanForteroche\Blog\Model\PostManager;
        $counterManager = new \JeanForteroche\Blog\Model\CounterManager;

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
        $postManager = new \JeanForteroche\Blog\Model\PostManager();

        $episode = $postManager->getPost(htmlspecialchars($_GET['edit']));
        $type = $episode->getType();

        // ATTRIBUTION DE L'ICONE
        if ($type == 'episode') {
            $type = 'ÉPISODE <i class="fab fa-envira"></i>';
        } elseif ($type == 'ticket') {
            $type = 'BILLET <i class="fas fa-bullhorn"></i>';
        }

        // CONVERSION creationDate EN datetime-local
        $originalDate = $episode->getCreationDate();
        $date = mb_strimwidth($originalDate, 10, 18);
        $date = str_replace('h', ':', $date);
        $dmY = mb_strimwidth($originalDate, 10, 10);
        $dmY = str_replace('/', '-', $dmY);
        $Ydm = date("Y/m/d", strtotime($dmY));
        $Ydm = str_replace('/', '-', $Ydm);
        $date = $Ydm . 'T' . mb_strimwidth($date, 13, 2) . ':' . mb_strimwidth($date, 16, 2);

        require "view/backend/articleEditor.php";
    }

    public function displayAllEpisodes()
    {
        $postManager = new \JeanForteroche\Blog\Model\PostManager();
        $commentManager = new \JeanForteroche\Blog\Model\CommentManager;
        $counterManager = new \JeanForteroche\Blog\Model\CounterManager;

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
        $postManager = new \JeanForteroche\Blog\Model\PostManager();
        $commentManager = new \JeanForteroche\Blog\Model\CommentManager;
        $counterManager = new \JeanForteroche\Blog\Model\CounterManager;

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
        $postManager = new \JeanForteroche\Blog\Model\PostManager();
        $commentManager = new \JeanForteroche\Blog\Model\CommentManager;
        $counterManager = new \JeanForteroche\Blog\Model\CounterManager;

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
        $postManager = new \JeanForteroche\Blog\Model\PostManager();
        $commentManager = new \JeanForteroche\Blog\Model\CommentManager;
        $counterManager = new \JeanForteroche\Blog\Model\CounterManager;

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
        $postManager = new \JeanForteroche\Blog\Model\PostManager();
        $commentManager = new \JeanForteroche\Blog\Model\CommentManager;
        $counterManager = new \JeanForteroche\Blog\Model\CounterManager;

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
        $postManager = new \JeanForteroche\Blog\Model\PostManager();
        $commentManager = new \JeanForteroche\Blog\Model\CommentManager();

        $comment = $commentManager->getComment(htmlspecialchars($_GET['see']));
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
        $postManager = new \JeanForteroche\Blog\Model\PostManager();

        // CHOIX DE L'ACTION
        if (isset($_GET['see'])) {
            $post = $postManager->getPost(htmlspecialchars($_GET['see']));
            $type = $post->getType();
        } else {
            $post = $postManager->getPost(htmlspecialchars($_GET['update']));
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
