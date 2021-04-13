<?php
class ideaController{
    private $_db;

    public function __construct($db)
    {
        $this->_db = $db;
    }

    public function run(){
        if (empty($_SESSION['authentifie'])) {
            header("Location: index.php?action=login"); # redirection HTTP vers l'action accueil
            die();
        }

        require_once(VIEWS_PATH . 'idea.php');
    }

}