<!--
    <div class="gestion_user_block">
        <div class="gestion_own_info_block">
            <?php foreach ($tab as $i => $element){ ?>
                <div class="row box has-background-grey-light background-color">
                    <div class="columns">
                        <div class="column is-6">
                            <div class="column content is-normal ">
                                <?php if ($isComment) { $idea = $this->_db->select_idea($element->id_idea())  ?>
                                    <p class="block is-size-5"> Sujet : <?php echo $idea->html_subject()?></p>
                                    <p class="block is-size-6"> Texte : <?php echo $idea->html_text()?></p>
                                <?php } else { ?>
                                    <p class="block is-size-5"> Sujet : <?php echo $element->html_subject()?></p>
                                    <p class="block is-size-6"> Texte : <?php echo $element->html_text()?></p>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="column">
                            <div class="column content is-normal">
                                <?php if ($isComment) { ?>
                                    <p class="block is-size-6">Commentaire : <?php echo $element->html_text()?></p>
                                    <p class="block is-size-6"><?php echo $element->creation_date()?></p>
                                <?php } else { ?>
                                    <img class="icon is-medium" src="views/img/etat/<?php echo $element->status()?>.ico" alt="status-users">
                                    <p class="is-size-6"> <?php echo $this->_db->countLikes($element->id_idea())?> like(s)</p>
                                    <p class="block is-size-6"><?php echo $element->html_submitted_date()?></p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
-->
<!--
<div class="user-card-handling">
    <div class="columns">
        <div class="column">
            <div class="media ">
                <div class="media-left" >
                    <figure class="image is-48x48">
                        <img src="views/img/etat/<?php echo $element->html_status()?>.ico" alt="Placeholder image">
                    </figure>

                </div>
                <div class="media-content">
                    <p class="title is-4"><?php echo $element->html_subject()?></p>
                    <p class="subtitle is-6"><?php echo $element->html_text()?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="media-content">
        <p class="subtitle is-6"><?php echo $element->html_submitted_date()?></p>
    </div>
</div>
-->


<div class="columns is-mobile button-width">
    <a class="button column is-info is-light <?php if ($isPost) echo "is-active"?>" href="index.php?action=profil&category=post">Mes postes</a>
    <a class="button column is-info is-light <?php if ($isLike) echo "is-active"?>" href="index.php?action=profil&category=like">Mes likes</a>
    <a class="button column is-info is-light <?php if ($isComment) echo "is-active"?>" href="index.php?action=profil&category=comment">Mes commentaires</a>
</div>


<div class="idea-handling">
    <?php foreach ($tabIdeas as $i => $idea){ ?>
        <div class="user-card-handling">
            <div class="columns">
                <div class="column">
                    <div class="media ">
                        <div class="media-left" >
                            <figure class="image is-48x48">
                                <img src="views/img/etat/<?php echo $idea->html_status()?>.ico" alt="Placeholder image">
                            </figure>

                        </div>
                        <div class="media-content">
                            <p class="title is-4"><?php echo $idea->html_subject()?></p>
                            <p class="subtitle is-6"><?php echo $idea->html_text()?></p>
                        </div>
                    </div>
                </div>

                <div class="column is-5 user-handling-button">
                    <div class="buttons has-addons navbar-end">
                        <form class="buttons are-medium" action="index.php?action=gestion_idea" method="post" style="position:relative;">
                            <input type="hidden" name="idea_gestion_id" value="<?php echo $idea->html_id_idea()?>">
                            <?php if ($idea->status() != 'C') { ?>
                                <input class="button is-danger is-light is-small" name="fermer" type="submit" value="Fermer">
                            <?php } if ($idea->status() == 'T') { ?>
                                <input class="button is-danger is-light is-small" name="refuser" type="submit" value="Refuser">
                                <input class="button is-danger is-light is-small" name="accepter" type="submit" value="Accepter">
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
            <div class="media-content">
                <p class="subtitle is-6"><?php echo $idea->html_submitted_date()?></p>
            </div>
        </div>
    <?php } ?>
</div>



<div class="user-handling">
    <?php foreach ($tabUsers as $i => $user){ ?>

    <?php
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
        $textstatut = "Désactiver";
    } else{
        $disable = "inactif";
        $textstatut = "Activer";
    }
    ?>
    <div class="user-card-handling">
        <div class="columns">
            <div class="column">
                <div class="media ">
                    <div class="media-left" >
                        <figure class="image is-48x48">
                            <img src="https://bulma.io/images/placeholders/96x96.png" alt="Placeholder image">
                        </figure>

                    </div>
                    <div class="media-content">
                        <p class="title is-4"><?php echo $user->html_username() ?></p>
                        <p class="subtitle is-6"><?php echo $user->html_email()?></p>
                    </div>
                </div>
            </div>

            <div class="column is-5 user-handling-button">
                <div class="buttons has-addons navbar-end">
                    <form class="buttons are-medium" action="index.php?action=gestion_user" method="post">
                        <input type="hidden" name="user_gestion_id" value="<?php echo $user->id()?>">
                        <input class="button is-danger is-light is-small" name="desactiver" type="submit" value="<?php echo $textstatut ?>">
                        <input class="button is-danger is-light is-small" name="privilegier" type="submit" value="<?php echo $textprivilege ?>">
                    </form>
                </div>
            </div>
        </div>
        <div class="media-content">
            <p class="subtitle is-6"><?php echo $admin . " " . $disable ?></p>
        </div>
    </div>
</div>
<?php } ?>
</div>