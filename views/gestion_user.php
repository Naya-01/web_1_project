<div class="gestion_user_title">
    <h1 class="title">Gestion des utilisateurs</h1>
</div>
<div class="gestion_user_block">
    <?php foreach ($tabUsers as $i => $user){ ?>
    <?php if ($user->admin() == 1) {
            $admin = "Administrateur";
            $textprivilege = "Enlever droits";
        } else {
            $admin = "Utilisateur";
            $textprivilege = "Ajouter droits";
        } ?>

    <?php if ($user->disabled() == 0) {
            $disable = "actif";
            $textstatut = "Désactiver";
        } else{
            $disable = "inactif";
            $textstatut = "Activer";
        }?>

    <div class="row box has-background-grey-light"><!--une idée-->
        <div class="columns">
            <div class="column is-2">
                <div class="pseudo has-text-black">
                    <p class="block"><img class="icon" src="views/img/profil.ico"
                                          alt="picture-user"> <?php echo $this->_db->getUsername($user->id()) ?> </p>
                </div>
            </div>

            <div class="infos">
                <div class="column content is-normal">
                    <p class="block is-size-5"> ID : <?php echo $user->id()?></p>
                    <p class="block is-size-5"> Email : <?php echo $user->html_email()?></p>
                    <p class="block is-size-5"><?php echo $admin . " " . $disable ?></p>
                </div>
            </div>

            <div class="column">
                <div class="navbar-end">
                    <form class="buttons are-medium" action="index.php?action=gestion_user" method="post">
                        <input type="hidden" name="user_gestion_id" value="<?php echo $user->id()?>">
                        <input class="button is-danger is-light is-small" name="desactiver" type="submit" value="<?php echo $textstatut ?>">
                        <input class="button is-danger is-light is-small" name="privilegier" type="submit" value="<?php echo $textprivilege ?>">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>