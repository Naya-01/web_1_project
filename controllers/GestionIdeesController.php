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

        $tabIdeas = $this->_db->select_ideas();
        require_once(VIEWS_PATH . 'gestion_idea.php');
    }
}