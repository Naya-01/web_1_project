<?php
class ProfileController {

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

        # Deletes comments system
        if(!empty($_POST['form_delete_comment'])){
            if(!$this->_db->is_comment_disable($_POST['comment_idea'])){
                $this->_db->disable_comment($_POST['comment_idea']);
            }
        }

        # Profile image upload
        if (!empty($_FILES) and !empty($_FILES['userfile'])) {
            if (($_FILES['userfile']['type'] == 'image/jpeg' or $_FILES['userfile']['type'] == 'image/png')) {
                if (getimagesize($_FILES['userfile']['tmp_name'])['mime'] == 'image/jpeg'
                    or getimagesize($_FILES['userfile']['tmp_name'])['mime'] == 'image/png') {

                    $origin = $_FILES['userfile']['tmp_name'];
                    $destination = VIEWS_PATH . "user_image/" . uniqid();
                    move_uploaded_file($origin, $destination);
                    $this->_db->modifyImage($_SESSION['id_user'], $destination);
                    $_SESSION['image'] = $destination;
                    $notification = "Votre photo de profil a été changée";
                }
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

        # Setting up the profile table
        $profileTab = array();
        foreach ($tab as $i => $element) {
            if ($isComment) {
                $profileTab[$i]['comment'] = $element->html_text();
                $element = $this->_db->select_idea($element->id_idea());
            }
            $profileTab[$i]['status'] = $element->html_status();
            $profileTab[$i]['subject'] = $element->html_subject();
            $profileTab[$i]['text'] = $element->html_text();
            $profileTab[$i]['date'] = $element->html_submitted_date();
            $profileTab[$i]['user'] = $this->_db->getUsername($element->id_user());
        }


        require_once(VIEWS_PATH . 'profile.php');
    }

}