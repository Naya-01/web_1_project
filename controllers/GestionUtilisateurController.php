<?php
class GestionUtilisateurController {

    private $_db;

    public function __construct($db)
    {
        $this->_db = $db;
    }

    public function run()
    {
        # Si un petit fûté écrit ?action=admin sans passer par l'action login
        if (empty($_SESSION['authentifie']) or !$_SESSION['admin']) {
            header("Location: index.php?action=login"); # redirection HTTP vers l'action login
            die();
        }
        $tabUsers = $this->_db->select_users();
        $admin = "Utilisateur";
        require_once(VIEWS_PATH . 'gestion_user.php');
    }
}