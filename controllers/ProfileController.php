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
            if(!$this->_db->isCommentDisabled($_POST['comment_idea'])){
                $this->_db->disableComment($_POST['comment_idea']);
            }
        }

        # Profile image upload
        if (!empty($_FILES) and !empty($_FILES['userfile']) and !empty($_FILES['userfile']['name'])) {
            $imageTypeName = $_FILES['userfile']['type'];
            if (!empty($imageTypeName)) {
                if ($imageTypeName == "image/jpeg" or $imageTypeName == "image/png" or $imageTypeName == "image/gif") {
                    if ($imageTypeName == getimagesize($_FILES['userfile']['tmp_name'])['mime']) {
                        $imageTypeName = "." . substr($imageTypeName, strpos($imageTypeName,"/") + 1);

                        # Delete old file
                        $oldDestination = $this->_db->getImage($_SESSION['id_user']);
                        if ($oldDestination != DEFAULT_PROFILE_PIC and file_exists($oldDestination)) unlink($oldDestination);

                        $destination = VIEWS_PATH . "user_image/" . uniqid() . $imageTypeName;
                        move_uploaded_file($_FILES['userfile']['tmp_name'], $destination);

                        $this->_db->modifyImage($_SESSION['id_user'], $destination);
                        $_SESSION['image'] = $destination;
                        $notification = "Votre photo de profil a été changée";
                    }
                }
            }
            if (empty($notification)) $notification = "L'image envoyée n'est pas conforme.";
        }

        # Access to likes, comments and ideas
        $tab = array();
        $isComment = false;
        $isPost = false;
        $isLike = false;
        if (!empty($_GET) and !empty($_GET['category'])) {
            if ($_GET['category'] == 'post') {
                $tab = $this->_db->selectIdeasWhereUserIs($_SESSION['id_user']);
                $isPost = true;

            } else if ($_GET['category'] == 'comment') {
                $tab = $this->_db->selectCommentsWhereUserIs($_SESSION['id_user']);
                $isComment = true;

            } else if ($_GET['category'] == 'like') {
                $tab = $this->_db->selectIdeasLikedBy($_SESSION['id_user']);
                $isLike = true;

            }
        }

        # Setting up the profile table
        $profileTab = array();
        foreach ($tab as $i => $element) {
            if ($isComment) {
                $profileTab[$i]['comment'] = $element->html_text();
                $profileTab[$i]['date'] = $element->creation_date();
                $element = $this->_db->selectIdea($element->id_idea());
            } else {
                $profileTab[$i]['date'] = $element->html_submitted_date();
            }
            $profileTab[$i]['status'] = $element->html_status();
            $profileTab[$i]['subject'] = $element->html_subject();
            $profileTab[$i]['text'] = $element->html_text();
            $profileTab[$i]['user'] = $this->_db->getUsername($element->id_user());
        }

        require_once(VIEWS_PATH . 'profile.php');
    }
}