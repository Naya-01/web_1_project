<?php
class AdminController {

    private $_db;

    public function __construct($db) {
        $this->_db = $db;
    }

    public function run() {

        # Security
        if (empty($_SESSION['authentifie'])) {
            header("Location: index.php?action=login"); # HTTP redirection to the login action
            die();
        }

        require_once(VIEWS_PATH . 'accueil.php');
    }

}