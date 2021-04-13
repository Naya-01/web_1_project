<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hello Bulma!</title>
    <link rel="stylesheet" type="text/css" href="<?php echo VIEWS_PATH ?>css/bulma/css/bulma.css">
    <link rel="stylesheet" type="text/css" href="<?php echo VIEWS_PATH ?>css/style.css">
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
                            <a class="button is-dark" href="https://bulma.io/">
                                Profil
                            </a>
                            <?php if ($_SESSION['admin']) {?>
                            <a class="button is-danger" href="index.php?action=gestion_user">
                                Utilisateurs
                            </a>
                            <a class="button is-danger" href="https://bulma.io/">
                                Postes
                            </a>
                            <?php } ?>
                            <a class="button is-danger" href="index.php?action=logout">
                                Deconnexion
                            </a>
                        </div>
                    </div>
                </div>
        </nav>
    </header>
<?php } ?>