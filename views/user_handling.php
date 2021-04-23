<div class="has-text-centered mt-5">
    <h1 class="title">Gestion des utilisateurs</h1>
</div>

<!-- Notification -->
<?php if (!empty($notification)) { ?>
    <div class="notification is-info is-light notification-handling">
        <?php echo $notification ?>
    </div>
<?php } ?>

<!-- All users -->
<?php foreach ($tabUsers as $i => $user){

    # Definition of statutes for each member
    if ($user->admin() == 1) {
        $admin = "Administrateur";
        $textprivilege = "Enlever droits";
    } else {
        $admin = "Utilisateur";
        $textprivilege = "Ajouter droits";
    }

    if ($user->disabled() == 0) {
        $disable = "actif";
        $textstatus = "Désactiver";
    } else{
        $disable = "inactif";
        $textstatus = "Activer";
    }
    ?>
    <div class="card card-theme">
        <div class="card-content">
            <div class="media">
                <div class="media-left">
                    <figure class="image is-48x48">
                        <img class="is-rounded" src="<?php echo $user->picture() ?>" alt="Profile image">
                    </figure>
                </div>
                <div class="media-content">
                    <p class="title is-4"><?php echo $user->html_username() ?></p>
                    <p class="subtitle is-6"><?php echo $user->html_email()?></p>
                    <p class="subtitle is-6"><?php echo $admin . " " . $disable ?></p>
                </div>
            </div>
            <div class="content">
                <div class="buttons has-addons navbar-end">
                    <form class="buttons are-medium" action="index.php?action=user_handling" method="post">
                        <input type="hidden" name="user-handling-id" value="<?php echo $user->id()?>">
                        <input class="button is-danger is-light is-small" name="disabled" type="submit" value="<?php echo $textstatus ?>">
                        <input class="button is-danger is-light is-small" name="privilege" type="submit" value="<?php echo $textprivilege ?>">
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>