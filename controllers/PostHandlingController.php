<?php
class PostHandlingController {

    private $_db;

    public function __construct($db) {
        $this->_db = $db;
    }

    public function run() {

        # Security
        if (empty($_SESSION['authentifie']) or $_SESSION['admin'] == false) {
            header("Location: index.php?action=login");
            die();
        }

        # Modification of the statutes in the database
        if (!empty($_POST) and !empty($_POST['post-handling-id'])) {
            if (!empty($_POST['refused'])) {
                $this->_db->setStatus($_POST['post-handling-id'], "R");
                $this->_db->setRefusedDate($_POST['post-handling-id']);
                $notification = "Le poste a été refusé.";

            } else if (!empty($_POST['accepted'])) {
                $this->_db->setStatus($_POST['post-handling-id'], "A");
                $this->_db->setAcceptedDate($_POST['post-handling-id']);
                $notification = "Le poste a été accepté.";

            } else if (!empty($_POST['closed'])) {
                $this->_db->setStatus($_POST['post-handling-id'], "C");
                $this->_db->setClosedDate($_POST['post-handling-id']);
                $notification = "Le poste a été fermé.";
            }
        }

        # List of all ideas
        $tabIdeas = $this->_db->select_T_ideas();

        # Create a username table
        $usernameTab = array();
        foreach ($tabIdeas as $i => $idea) {
            $usernameTab[$i]['user'] = $this->_db->getUsername($idea->id_user());
        }

        require_once(VIEWS_PATH . 'post_handling.php');
    }
}