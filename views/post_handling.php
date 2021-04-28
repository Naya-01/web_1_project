<!-- Page title -->
<div class="has-text-centered mt-5">
    <h1 class="title">Gestion des postes</h1>
</div>

<!-- Notification -->
<?php if (!empty($notification)) { ?>
    <div class="notification is-info is-light notification-handling">
        <?php echo $notification ?>
    </div>
<?php } ?>

<!-- Idea card -->
<?php foreach ($tabIdeas as $i => $idea) { ?>
    <div class="card card-theme">
        <div class="card-content">
            <div class="media">
                <div class="media-left">
                    <figure class="image is-48x48">
                        <img src="<?php echo VIEWS_PATH ?>img/state/<?php echo $idea->html_status()?>.ico" alt="Statut">
                    </figure>
                </div>
                <div class="media-content">
                    <p class="title is-4"><?php echo $idea->html_subject()?></p>
                    <p class="subtitle is-6">By <?php echo $usernameTab[$i]['user'] ?></p>
                </div>
            </div>
            <div class="content">
                <?php echo $idea->html_text()?>
                <br>
                <time datetime="2011-11-18T14:54:39.929"><strong><?php echo $idea->html_submitted_date()?></strong></time>
                <div class="buttons has-addons navbar-end">
                    <form class="buttons are-medium" action="index.php?action=post_handling" method="post">
                        <input type="hidden" name="post-handling-id" value="<?php echo $idea->html_id_idea()?>">
                        <?php if ($idea->status() != 'C') { ?>
                            <input class="button is-danger is-light is-small" name="closed" type="submit" value="Fermer">
                        <?php } if ($idea->status() == 'T') { ?>
                            <input class="button is-danger is-light is-small" name="refused" type="submit" value="Refuser">
                            <input class="button is-danger is-light is-small" name="accepted" type="submit" value="Accepter">
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>