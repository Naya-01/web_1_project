<?php
class HomeController{

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
            $checkIdea=$this->_db->selectIdea($_POST['like_id_idea']);
            if($checkIdea->status() != 'C'){
                if ($this->_db->voteExists($_SESSION['id_user'],$_POST['like_id_idea'])) {
                    $notification_like="Vous avez déjà voté pour cette idée !";
                } else {
                    $selectIdea=$this->_db->selectIdea($_POST['like_id_idea']);
                    if($_SESSION['id_user']==$selectIdea->id_user()){
                        $notification_like ="vous ne pouvez pas voter pour votre propre publication!";
                    }else{
                        $notification_like = "Votre like été pris en compte.";
                        $this->_db->insertVote($_SESSION['id_user'], $_POST['like_id_idea']);
                    }
                }
            }else{
                $notification_like="Vous ne pouvez pas voter pour une idée fermer!";
            }
        }


        # Filter
        # List of ideas to display
        if(!empty($_POST['form_status'])){
            $tabIdeas = $this->_db->selectIdeasWhereStatusIs($_POST['form_status']);
        }else if(!empty($_POST['form_limit'])){
            $_SESSION['limit'] = $_POST['form_limit'];
            $tabIdeas = $this->_db->selectIdeasWithNumberLimit($_SESSION['popularity'],$_SESSION['limit']);
        }else if (!empty($_POST['popularity'])){
            $_SESSION['popularity'] = $_POST['popularity'];
            $tabIdeas = $this->_db->selectIdeasWithNumberLimit($_SESSION['popularity'],$_SESSION['limit']);
        }else if(!empty($_POST['date'])){
            $tabIdeas =$this->_db->selectIdeasByDate($_SESSION['limit']);
        } else{ # Default
            $_SESSION['popularity'] = 'uncrescent'; # When arrived on the, the popularity is set to uncrescent by default
            $_SESSION['limit'] = 'all'; # When arrived on the page, the limit is set to all ideas by default
            $tabIdeas = $this->_db->selectIdeasWithNumberLimit($_SESSION['popularity'],$_SESSION['limit']);
        }



        foreach($tabIdeas as $i => $idea){
            $tabUser[$i]=$this->_db->getUser($tabIdeas[$i]->id_user());
        }



        require_once(VIEWS_PATH . 'home.php');
    }
}