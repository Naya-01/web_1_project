<?php
class AccueilController{

    private $_db;

    public function __construct($db)
    {
        $this->_db = $db;
    }

    public function run()
    {
        if (empty($_SESSION['authentifie'])) {
            header("Location: index.php?action=login"); # redirection HTTP vers l'action login
            die();
        }
        $tabIdeas = $this->_db->select_ideas();
        $notification_like="";
        if(!empty($_POST['form_like'])){
            if($this->_db->vote_exist($_SESSION['id_user'],$_POST['like_id_idea'])){
                $notification_like="vous avez deja voté pour cette idée!!!";
            }else{
                $notification_like="vôtre like a été ajouté";
                $this->_db->insert_vote($_SESSION['id_user'],$_POST['like_id_idea']);
            }
        }





        require_once(VIEWS_PATH . 'accueil.php');
    }
}