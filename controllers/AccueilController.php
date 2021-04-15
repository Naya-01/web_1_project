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
            $checkIdea=$this->_db->select_idea($_POST['like_id_idea']);
            if($checkIdea->status()!='C'){
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
            }else{
                $notification_like="Vous ne pouvez pas voter pour une idée fermer!";
            }
        }

        # Filter
        # List of ideas to display
        if(!empty($_POST['form_accepted'])){
            $tabIdeas = $this->_db->select_status_idea("A");
        }else if(!empty($_POST['form_refused'])){
            $tabIdeas =$this->_db->select_status_idea("R");
        }else if(!empty($_POST['form_closed'])){
            $tabIdeas = $this->_db->select_status_idea("C");
        }else if(!empty($_POST['form_3'])){
            $tabIdeas = $this->_db->select_idea_limit("3");
        }else if(!empty($_POST['form_10'])){
            $tabIdeas = $this->_db->select_idea_limit("10");
        }else if(!empty($_POST['form_all'])){
            $tabIdeas = $this->_db->select_default_idea();
        } else if (!empty($_POST['croissant'])){
            $tabIdeas = $this->_db->select_table_idea_like_crescent();
        } else if (!empty($_POST['decroissant'])){
            $tabIdeas = $this->_db->select_table_idea_like_decrescent();
        } else {
            $tabIdeas = $this->_db->select_ideas();
        }




//        $tabIdeas = $this->_db->select_ideas();

        require_once(VIEWS_PATH . 'accueil.php');
    }
}