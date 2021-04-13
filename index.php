<?php
date_default_timezone_set('Europe/Brussels');
define('VIEWS_PATH', 'views/');
define('CONTROLLERS_PATH', 'controllers/');
define('DATEDUJOUR', date('j/m/Y'));
define('NOW', date('Y-m-d H:i:s'));

# Active le mécanisme des sessions
session_start();

# Automatisation de l'inclusion des classes de la couche modèle
function chargerClasse($classe)
{
    require_once('models/' . $classe . '.class.php');
}
spl_autoload_register('chargerClasse');

# Connexion à la db;
$db=Db::getInstance();

# S'il n'y a pas de variable GET 'action' dans l'URL, elle est créée ici à la valeur 'accueil'
if (empty($_GET['action'])) {
    $_GET['action'] = 'login';
}
$header_footer=false;
if($_GET['action'] != 'login'){
    $header_footer=true;
}
include(VIEWS_PATH. 'header.php');


switch ($_GET['action']) {
    case 'admin':
        require_once(CONTROLLERS_PATH.'AdminController.php');
        $controller = new AdminController($db);
        break;
    case 'accueil':
        require_once(CONTROLLERS_PATH.'AccueilController.php');
        $controller = new AccueilController($db);
        break;
    case 'logout':
        require_once(CONTROLLERS_PATH.'LogoutController.php');
        $controller = new LogoutController();
        break;
    case 'newIdea':
        require_once(CONTROLLERS_PATH.'newIdeaController.php');
        $controller = new newIdeaController($db);
        break;
    case 'idea':
        require_once(CONTROLLERS_PATH.'ideaController.php');
        $controller = new ideaController($db);
        break;
    case 'gestion_user':
        require_once(CONTROLLERS_PATH.'GestionUtilisateurController.php');
        $controller = new GestionUtilisateurController($db);
        break;
    default:
        require_once(CONTROLLERS_PATH . 'LoginController.php');
        $controller = new LoginController($db);
        break;
}

# Exécution du contrôleur défini dans le switch précédent
$controller->run();