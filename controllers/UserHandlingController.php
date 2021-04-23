<?php
class UserHandlingController {

    private $_db;

    public function __construct($db) {
        $this->_db = $db;
    }

    public function run() {

        # Security
        if (empty($_SESSION['authentifie']) or $_SESSION['admin'] == false) {
            header("Location: index.php?action=login");
            die();
        }

        # Modification of the statutes in the database
        if (!empty($_POST) and !empty($_POST['user-handling-id'])) {
            if (!empty($_POST['disabled'])) {
                $this->_db->modifyDisableState($_POST['user-handling-id']);
                $notification = "Le compte de " . $this->_db->getUsername($_POST['user-handling-id']) . " ";
                ($this->_db->isDisabled($_POST['user-handling-id'])) ? $notification .= "a été désactivé" : $notification .= "a été activé";

            } else if (!empty($_POST['privilege'])) {
                $this->_db->modifyPrivilegeState($_POST['user-handling-id']);
                $notification = "Le compte de " . $this->_db->getUsername($_POST['user-handling-id']) . " ";
                ($this->_db->isAdmin($_POST['user-handling-id'])) ? $notification .= "est désormais administrateur" : $notification .= "est désormais un utilisateur";
            }

            if ($_POST['user-handling-id'] == $_SESSION['id_user']) {
                header("Location: index.php?action=login");
                die();
            }
        }

        # List of all users
        $tabUsers = $this->_db->selectUsers();

        require_once(VIEWS_PATH . 'user_handling.php');
    }
}