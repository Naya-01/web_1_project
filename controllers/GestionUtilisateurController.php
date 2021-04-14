<?php
class GestionUtilisateurController {

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
        if (!empty($_POST)) {
            if (!empty($_POST['user_gestion_id'])) {
                if (!empty($_POST['desactiver'])) {
                    $this->_db->modify_disable($_POST['user_gestion_id']);
                    $notification = "Le compte de " . $this->_db->getUsername($_POST['user_gestion_id']) . " ";
                    ($this->_db->is_disabled($_POST['user_gestion_id'])) ? $notification .= "a été désactivé" : $notification .= "a été activé";
                } else if (!empty($_POST['privilegier'])) {
                    $this->_db->modify_admin($_POST['user_gestion_id']);
                    $notification = "Le compte de " . $this->_db->getUsername($_POST['user_gestion_id']) . " ";
                    ($this->_db->is_admin($_POST['user_gestion_id'])) ? $notification .= "est désormais administrateur" : $notification .= "est désormais un utilisateur";
                }

                if ($_POST['user_gestion_id'] == $_SESSION['id_user']) {
                    header("Location: index.php?action=login");
                    die();
                }

            }
        }

        # List of all users
        $tabUsers = $this->_db->select_users();

        require_once(VIEWS_PATH . 'gestion_user.php');
    }
}