<?php
class AccueilController{

    private $_db;

    public function __construct($db) {
        $this->_db = $db;
    }

    public function run()
    {
        # Si un petit fûté écrit ?action=admin sans passer par l'action login
        if (empty($_SESSION['authentifie'])) {
            header("Location: index.php?action=login"); # redirection HTTP vers l'action login
            die();
        }

        # Manage notifications and likes system
        $notification_like = "";
        if (!empty($_POST['form_like'])) {
            if ($this->_db->vote_exist($_SESSION['id_user'],$_POST['like_id_idea'])) {
                $notification_like="Vous avez déjà voté pour cette idée !";
            } else {
                $selectIdea=$this->_db->select_idea($_POST['like_id_idea']);
                if($_SESSION['id_user']==$selectIdea->id_user()){
                    $notification_like ="vous ne pouvez pas voter pour votre propre publication!";
                }else{
                    $notification_like = "Votre like été pris en compte.";
                    $this->_db->insert_vote($_SESSION['id_user'], $_POST['like_id_idea']);
                }
            }
        }

        # List of ideas to display
        $tabIdeas = $this->_db->select_ideas();

        require_once(VIEWS_PATH . 'accueil.php');
    }
}