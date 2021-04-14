<?php
class GestionIdeesController {

    private $_db;

    public function __construct($db) {
        $this->_db = $db;
    }

    public function run() {

        # Security
        if (empty($_SESSION['authentifie']) or $_SESSION['admin'] == false) {
            header("Location: index.php?action=login"); # redirection HTTP vers l'action login
            die();
        }

        # Modification of the statutes in the database
        if (!empty($_POST) and !empty($_POST['idea_gestion_id'])) {
            if (!empty($_POST['refuser'])) {
                $this->_db->setStatus($_POST['idea_gestion_id'], "R");
                $this->_db->setRefusedDate($_POST['idea_gestion_id']);
                $notification = "Le poste a été refusé.";
            } else if (!empty($_POST['desactiver'])) {
                $notification = "Le poste a été désactivé.";
            } else if (!empty($_POST['accepter'])) {
                $this->_db->setStatus($_POST['idea_gestion_id'], "A");
                $this->_db->setAcceptedDate($_POST['idea_gestion_id']);
                $notification = "Le poste a été acceptée.";
            } else if (!empty($_POST['fermer'])) {
                $this->_db->setStatus($_POST['idea_gestion_id'], "C");
                $this->_db->setClosedDate($_POST['idea_gestion_id']);
                $notification = "Le poste a été fermé.";
            }
        }

        # List of all ideas
        $tabIdeas = $this->_db->select_T_ideas();

        require_once(VIEWS_PATH . 'gestion_idea.php');
    }
}