<?php
class GestionUtilisateurController {

    private $_db;

    public function __construct($db) {
        $this->_db = $db;
    }

    public function run() {
        if (empty($_SESSION['authentifie']) or $_SESSION['admin'] == false) {
            header("Location: index.php?action=login");
            die();
        }

        if (!empty($_POST)) {
            if (!empty($_POST['user_gestion_id'])) {
                if (!empty($_POST['desactiver'])) {
                    $this->_db->modify_disable($_POST['user_gestion_id']);
                } else if (!empty($_POST['privilegier'])) {
                    $this->_db->modify_admin($_POST['user_gestion_id']);
                }

                if ($_POST['user_gestion_id'] == $_SESSION['id_user']) {
                    header("Location: index.php?action=login");
                    die();
                }

            }
        }

        $tabUsers = $this->_db->select_users();
        require_once(VIEWS_PATH . 'gestion_user.php');
    }
}