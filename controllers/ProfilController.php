<?php
class ProfilController {

    private $_db;

    public function __construct($db) {
        $this->_db = $db;
    }

    public function run() {

        # Security
        if (empty($_SESSION['authentifie'])) {
            header("Location: index.php?action=login");
            die();
        }

        # Setting up the account status (views)
        if ($_SESSION['admin']) {
            $statutColor = "red";
            $statutName = "Administrateur";
        } else {
            $statutColor = "green";
            $statutName = "Utilisateur";
        }

        #Deletes comments system
        if(!empty($_POST['form_delete_comment'])){
            if(!$this->_db->is_comment_disable($_POST['comment_idea'])){
                $this->_db->disable_comment($_POST['comment_idea']);
            }
        }

        # Access to likes, comments and ideas
        $tab = array();
        $isComment = false;
        $isPost = false;
        $isLike = false;
        if (!empty($_GET) and !empty($_GET['category'])) {
            if ($_GET['category'] == 'post') {
                $tab = $this->_db->select_idea_where_user_is($_SESSION['id_user']);
                $isPost = true;

            } else if ($_GET['category'] == 'comment') {
                $tab = $this->_db->select_comments_where_user_is($_SESSION['id_user']);
                $isComment = true;

            } else if ($_GET['category'] == 'like') {
                $tab = $this->_db->select_idea_user_like($_SESSION['id_user']);
                $isLike = true;

            }
        }

        require_once(VIEWS_PATH . 'profil.php');
    }

}