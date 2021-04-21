<?php
class LoginController {

    private $_db;

    public function __construct($db) {
        $this->_db = $db;
    }

    public function run() {

        # Security
        if (!empty($_SESSION['authentifie'])) {
            header("Location: index.php?action=accueil"); # redirection HTTP vers l'action accueil
            die();
        }

        # Setting up variables
        $notification = '';
        $condition = false;

        # Handling connection errors
        if (!empty($_POST['form_login'])) {
            $condition = true;
            if (empty($_POST['email_login']) || empty($_POST['password_login'])) {
                $notification = "Veuillez remplir les champs de connexion !";
            } elseif (!$this->_db->valider_email($_POST['email_login'], $_POST['password_login'])) {
                # Authentication is not correct
                $notification = 'Vos données d\'authentification ne sont pas correctes.';
            }elseif ($this->_db->is_disabled($this->_db->getIdUser($_POST['email_login']))==1){
                $notification="votre compte est désactivé";
            } else {
                # The user is well authenticated
                # A session variable $_SESSION['authentifie'] is created
                $_SESSION['authentifie'] = 'ok';
                $_SESSION['email'] = $_POST['email_login'];
                $_SESSION['id_user'] = $this->_db->getIdUser($_POST['email_login']);
                $_SESSION['username']= $this->_db->getUsername($_SESSION['id_user']);
                $_SESSION['admin']= $this->_db->is_admin($_SESSION['id_user']);
                $_SESSION['disabled']= $this->_db->is_disabled($_SESSION['id_user']);

                # HTTP redirection to request the 'admin' page
                header("Location: index.php?action=accueil");
                die();
            }
        }

        # Handling registration errors
        if (!empty($_POST['form_register'])) {
            if (empty($_POST['username_register']) || empty($_POST['password_register']) || empty($_POST['email_register'])) {
                $notification = "Veuillez remplir les champs d'inscription !";
                $condition =true;

            } elseif ($this->_db->email_exists($_POST['email_register'])) {
                $notification = 'L\'email existe déjà, choisissez une autre adresse mail.';
                $condition =true;

            }elseif ($this->_db->username_exists($_POST['username_register'])){
                $notification = 'Le pseudo existe déjà, choisissez un autre pseudo.';
                $condition =true;

            }else {
                $this->_db->insert_user($_POST['username_register'], $_POST['email_register'], password_hash($_POST['password_register'], PASSWORD_BCRYPT));
                $notification = 'Le membre ' . $_POST['username_register'] . ' a bien été créé';
                $condition =true;

            }
        }

        require_once(VIEWS_PATH . 'login.php');
    }
}
