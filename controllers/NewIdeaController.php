<?php
class NewIdeaController{

    private $_db;

    public function __construct($db) {
        $this->_db = $db;
    }

    public function run() {

        # Security
        if (empty($_SESSION['authentifie'])) {
            header("Location: index.php?action=login"); # redirection HTTP vers l'action login
            die();
        }

        # Insertion of new ideas
        $condition=false;
        if(!empty($_POST['form_post_idea'])){
            $condition=true;
            if(!empty($_POST['form_subject']) && !empty($_POST['form_subject_text'])) {
                $subject =$_POST['form_subject'];
                $text = $_POST['form_subject_text'];
                if(strlen($subject) > 60) {
                    $notification_post = "Vous avez dépassé les 60 caractères autorisés pour le sujet !";

                }else if(strlen($text) > 200) {
                    $notification_post = "Vous avez dépassé les 200 caractères autorisés pour la description !";

                } else {
                    $notification_post = "Idée ajoutée";
                    $this->_db->insertIdea($_SESSION['id_user'],$_POST['form_subject'], $_POST['form_subject_text']);
                }
            } else {
                $notification_post = "Veuillez remplir les champs afin de publier une idée.";
            }
        }

        require_once(VIEWS_PATH . 'newIdea.php');
    }


}