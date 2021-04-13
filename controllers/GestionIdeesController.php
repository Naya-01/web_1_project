<?php
class GestionIdeesController {

    private $_db;

    public function __construct($db)
    {
        $this->_db = $db;
    }

    public function run()
    {
        # Si un petit fûté écrit ?action=admin sans passer par l'action login
        if (empty($_SESSION['authentifie']) or $_SESSION['admin'] == false) {
            header("Location: index.php?action=login"); # redirection HTTP vers l'action login
            die();
        }

        if (!empty($_POST) and !empty($_POST['idea_gestion_id'])) {
            if (!empty($_POST['refuser'])) {
                $this->_db->setStatus($_POST['idea_gestion_id'], "R");
                $this->_db->setRefusedDate($_POST['idea_gestion_id']);
            } else if (!empty($_POST['desactiver'])) {

            } else if (!empty($_POST['accepter'])) {
                $this->_db->setStatus($_POST['idea_gestion_id'], "A");
                $this->_db->setAcceptedDate($_POST['idea_gestion_id']);
            } else if (!empty($_POST['fermer'])) {
                $this->_db->setStatus($_POST['idea_gestion_id'], "C");
                $this->_db->setClosedDate($_POST['idea_gestion_id']);
            }
        }

        $tabIdeas = $this->_db->select_T_ideas();
        require_once(VIEWS_PATH . 'gestion_idea.php');
    }
}