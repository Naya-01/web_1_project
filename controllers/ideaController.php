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
        $id_idea=$_GET['id_idea'];
        $idea=$this->_db->select_idea($id_idea);

        if(!empty($_POST['form_like'])){
            if($this->_db->vote_exist($_SESSION['id_user'],$_POST['like_id_idea'])){

            }else{
                $this->_db->insert_vote($_SESSION['id_user'],$_POST['like_id_idea']);
            }
        }

        require_once(VIEWS_PATH . 'idea.php');
    }

}