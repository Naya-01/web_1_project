<?php
    # Definition of constants
    date_default_timezone_set('Europe/Brussels');
    define('VIEWS_PATH', 'views/');
    define('DEFAULT_PROFILE_PIC', VIEWS_PATH . 'img/user_image/default_profile_pic.ico');
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

    # If there is no GET variable 'action' in the URL, it is created here at the value 'home'
    if (empty($_GET['action'])) {
        $_GET['action'] = 'login';
    }

    # Allows the display (or not) of the header and the update of the admin & disabled attributes
    $header_footer=true;
    if (empty($_SESSION['authentifie'])) {
        $header_footer=false;
    } else {
        $_SESSION['admin'] = $db->isAdmin($_SESSION['id_user']);
        $_SESSION['disabled']= $db->isDisabled($_SESSION['id_user']);
        if ($_SESSION['disabled'] == 1) {
            $_SESSION = array();
            header("Location: index.php?action=login");
            die();
        }
    }

    include(VIEWS_PATH. 'header.php');

    switch ($_GET['action']) {
        case 'home':
            require_once(CONTROLLERS_PATH.'HomeController.php');
            $controller = new HomeController($db);
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
        case 'user_handling':
            require_once(CONTROLLERS_PATH . 'UserHandlingController.php');
            $controller = new UserHandlingController($db);
            break;
        case 'post_handling':
            require_once(CONTROLLERS_PATH . 'PostHandlingController.php');
            $controller = new PostHandlingController($db);
            break;
        case 'profil':
            require_once(CONTROLLERS_PATH . 'ProfileController.php');
            $controller = new ProfileController($db);
            break;
        default:
            require_once(CONTROLLERS_PATH . 'LoginController.php');
            $controller = new LoginController($db);
            break;
    }

    # Execution of the controller defined in the previous switch
    $controller->run();

    require_once(VIEWS_PATH . "footer.php");