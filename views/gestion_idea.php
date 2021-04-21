
<div class="gestion_user_title">
    <h1 class="title">Gestion des postes</h1>
</div>

<?php if (!empty($notification)) { ?>
    <div class="notification is-info is-light notification-handling">
        <button class="delete"></button>
        <?php echo $notification ?>
    </div>
<?php } ?>

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

                <div class="column is-5  user-handling-button">
                    <div class="buttons has-addons navbar-end">
                        <form class="buttons are-medium" action="index.php?action=gestion_idea" method="post" style="position:relative;">
                            <input type="hidden" name="idea_gestion_id" value="<?php echo $idea->html_id_idea()?>">
                            <input class="button is-danger is-light is-small" name="desactiver" type="submit" value="Désactiver">
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