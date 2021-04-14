<?php
    # Definition of constants
    date_default_timezone_set('Europe/Brussels');
    define('VIEWS_PATH', 'views/');
    define('CONTROLLERS_PATH', 'controllers/');
    define('DATEDUJOUR', date('j/m/Y'));
    define('NOW', date('Y-m-d H:i:s'));

    # Activate the session mechanism
    session_start();

    # Automating the inclusion of model layer classes
    function chargerClasse($classe) {
        require_once('models/' . $classe . '.class.php');
    }
    spl_autoload_register('chargerClasse');

    # Connection to the database
    $db = Db::getInstance();


    # If there is no GET variable 'action' in the URL, it is created here at the value 'accueil'
    if (empty($_GET['action'])) {
        $_GET['action'] = 'login';
    }

    # Allows the display (or not) of the header and the update of the admin & disabled attributes
    $header_footer=true;
    if(empty($_SESSION['authentifie'])){
        $header_footer=false;
    } else {
        $_SESSION['admin'] = $db->is_admin($_SESSION['id_user']);
        $_SESSION['disabled']= $db->is_disabled($_SESSION['id_user']);
        if ($_SESSION['disabled'] == 1) {
            $_SESSION = array();
            header("Location: index.php?action=login");
            die();
        }
    }

    include(VIEWS_PATH. 'header.php');

    switch ($_GET['action']) {
        /*
        case 'admin':
            require_once(CONTROLLERS_PATH.'AdminController.php');
            $controller = new AdminController($db);
            break;
        */
        case 'accueil':
            require_once(CONTROLLERS_PATH.'AccueilController.php');
            $controller = new AccueilController($db);
            break;
        case 'logout':
            require_once(CONTROLLERS_PATH.'LogoutController.php');
            $controller = new LogoutController();
            break;
        case 'newIdea':
            require_once(CONTROLLERS_PATH . 'NewIdeaController.php');
            $controller = new NewIdeaController($db);
            break;
        case 'idea':
            require_once(CONTROLLERS_PATH . 'IdeaController.php');
            $controller = new IdeaController($db);
            break;
        case 'gestion_user':
            require_once(CONTROLLERS_PATH.'GestionUtilisateurController.php');
            $controller = new GestionUtilisateurController($db);
            break;
        case 'gestion_idea':
            require_once(CONTROLLERS_PATH.'GestionIdeesController.php');
            $controller = new GestionIdeesController($db);
            break;
        case 'profil':
            require_once(CONTROLLERS_PATH.'ProfilController.php');
            $controller = new ProfilController($db);
            break;
        default:
            require_once(CONTROLLERS_PATH . 'LoginController.php');
            $controller = new LoginController($db);
            break;
    }

    # Execution of the controller defined in the previous switch
    $controller->run();

    require_once(VIEWS_PATH . "footer.php");