<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>YOUReview</title>
    <link rel="stylesheet" type="text/css" href="<?php echo VIEWS_PATH ?>css/bulma/css/bulma.css">
    <link rel="stylesheet" type="text/css" href="<?php echo VIEWS_PATH ?>css/style.css">

    <link rel="shortcut icon" href="<?php echo VIEWS_PATH ?>/img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?php echo VIEWS_PATH ?>/img/favicon.ico" type="image/x-icon">
</head>
<body>
<?php if ($header_footer) { ?>
    <header>
        <nav class="navbar is-info" id="navbar">
            <div class="navbar-brand">
                <a class="navbar-item" href="index.php?action=accueil">
                    <img src="views/img/logo-blanc.png" alt="Youreview-logo">
                </a>
            </div>
            <div class="navbar-end">
                <div class="navbar-item">
                    <div class="buttons">
                        <a class="button is-dark" href="index.php?action=accueil">
                            Accueil
                        </a>
                        <a class="button is-dark" href="index.php?action=profil">
                            Profil
                        </a>
                        <?php if ($_SESSION['admin']) {?>
                            <a class="button is-dark" href="index.php?action=gestion_user">
                                Utilisateurs
                            </a>
                            <a class="button is-dark" href="index.php?action=gestion_idea">
                                Postes
                            </a>
                        <?php } ?>
                        <a class="button is-danger" href="index.php?action=logout">
                            Déconnexion
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
<?php } ?>