<?php

class LoginController
{

    private $_db;

    public function __construct($db)
    {
        $this->_db = $db;
    }

    public function run()
    {
        # Si un distrait écrit ?action=accueil en étant déjà authentifié
        if (!empty($_SESSION['authentifie'])) {
            header("Location: index.php?action=accueil"); # redirection HTTP vers l'action accueil
            die();
        }
        #variable
        $notification = '';
        $condition = false;

        if (!empty($_POST['form_login'])) {
            if (empty($_POST['email_login']) || empty($_POST['password_login'])) {
                $notification = "Veuillez remplir les champs de connexion !";
                $condition =true;
            } elseif (!$this->_db->valider_email($_POST['email_login'], $_POST['password_login'])) {
                # L'authentification n'est pas correcte
                $notification = 'Vos données d\'authentification ne sont pas correctes.';
                $condition =true;
            } else {
                # L'utilisateur est bien authentifié
                # Une variable de session $_SESSION['authentifie'] est créée
                $_SESSION['authentifie'] = 'ok';
                $_SESSION['email'] = $_POST['email_login'];
                $_SESSION['id_user'] = $this->_db->getIdUser($_POST['email_login']);
                $_SESSION['username']= $this->_db->getUsername($_SESSION['id_user']);
                $_SESSION['admin']= $this->_db->is_admin($_SESSION['id_user']);
                $_SESSION['disabled']= $this->_db->is_disabled($_SESSION['id_user']);
                if ($_SESSION['disabled'] == 1) $_SESSION = array();
                # Redirection HTTP pour demander la page admin
                header("Location: index.php?action=accueil");
                die();
            }
        }

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

        # Ecrire ici la vue
        require_once(VIEWS_PATH . 'login.php');
    }
}

?>