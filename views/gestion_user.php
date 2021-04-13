<div class="gestion_user_title">
    <h1 class="title">Gestion des utilisateurs</h1>
</div>
<div class="gestion_user_block">
    <?php foreach ($tabUsers as $i => $user){ ?>
    <?php if ($user->admin() == 1) $admin = "Administrateur"; else $admin = "Utilisateur" ?>
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
                    <p class="block is-size-5"><?php echo $admin ?></p>
                </div>
            </div>

            <div class="column">
                <div class="navbar-end">
                    <div class="buttons are-medium">
                        <button class="button">Privilégier</button>
                        <button class="button">Désactiver</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>