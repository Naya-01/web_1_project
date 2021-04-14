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

        # affichage de l'idée selectionner/affichage de l'idée mise dans le lien
        $id_idea=$_GET['id_idea'];
        if($this->_db-> idea_exist($id_idea)){
            $idea=$this->_db->select_idea($id_idea);;
        }else{
            header("Location: index.php?action=accueil"); # redirection HTTP vers l'action accueil
            die();
        }



        if(!empty($_POST['form_like'])){
            if($this->_db->vote_exist($_SESSION['id_user'],$_POST['like_id_idea'])){

            }else{
                $this->_db->insert_vote($_SESSION['id_user'],$_POST['like_id_idea']);
            }
        }


        require_once(VIEWS_PATH . 'idea.php');
    }

}