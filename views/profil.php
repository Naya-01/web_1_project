
<!-- Basic informations -->
<div class="gestion_user_title">
    <h1 class="title">Profil</h1>
</div>

<!--
<div class="profil_status">
    <p class="block is-size-6" style="color: <?php echo $statutColor ?>;"><?php echo $statutName ?></p>
</div>

<div class="image_profil_block image is-128x128">
    <img class="image_profil is-rounded" src="<?php echo VIEWS_PATH ?>/img/profil.ico">
</div>

<div class="profil_basic_info">
    <p class="block is-size-6"><?php echo $_SESSION['username'] ?></p>
    <p class="block is-size-6"><?php echo $_SESSION['email'] ?></p>
</div>
-->



<!-- /!\ Modals /!\ -->
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<!-- My posts -->
<div class="modal modal-idea">
    <div class="modal-background"></div>
    <div class="modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title">Mes postes</p>
            <button class="delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
            <div class="gestion_user_block">

                <div class="gestion_own_info_block">
                    <?php foreach ($tabIdeas as $i => $idea){ ?>
                        <div class="row box has-background-grey-light background-color">
                            <div class="columns">
                                <div class="column is-6">
                                    <div class="column content is-normal ">
                                        <p class="block is-size-5"> Sujet : <?php echo $idea->html_subject()?></p>
                                        <p class="block is-size-6"> Texte : <?php echo $idea->html_text()?></p>
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="column content is-normal">
                                        <img class="icon is-medium" src="views/img/etat/<?php echo $idea->status()?>.ico" alt="status-users">
                                        <p class="is-size-6"> <?php echo $this->_db->countLikes($idea->id_idea())?> like(s)</p>
                                        <p class="block is-size-6"><?php echo $idea->html_submitted_date()?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>

            </div>
        </section>
        <footer class="modal-card-foot">
        </footer>
    </div>
</div>

<!-- My comments -->
<div class="modal modal-comment">
    <div class="modal-background"></div>
    <div class="modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title">Mes Commentaires</p>
            <button class="delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
            <div class="gestion_user_block">

                <div class="gestion_own_info_block">
                    <?php foreach ($tabComment as $i => $comment){ ?>
                        <div class="row box has-background-grey-light background-color">
                            <div class="columns">
                                <div class="column is-6">
                                    <div class="column content is-normal ">
                                        <p class="block is-size-5"> Sujet du poste :<br> <?php echo $this->_db->select_idea($comment->html_id_idea())->html_subject() ?></p>
                                    </div>
                                </div>
                                <div class="column is-6">
                                    <div class="column content is-normal ">
                                        <p class="block is-size-6"> Commentaire : <br> <?php echo $comment->html_text()?></p>
                                        <form action="?action=profil" method="post">
                                            <input type="hidden" name="comment_idea" value="<?php echo $comment->html_id_comment() ?>">
                                            <p><input class="button is-danger" type="submit" value="Supprimer" name="form_delete_comment"></p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>

            </div>
        </section>
        <footer class="modal-card-foot">
        </footer>
    </div>
</div>

<!-- My likes -->
<div class="modal modal-like">
    <div class="modal-background"></div>
    <div class="modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title">Mes likes</p>
            <button class="delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
            <div class="gestion_user_block">

                <div class="gestion_own_info_block">
                    <?php foreach ($tabLike as $i => $idea){ ?>
                        <div class="row box has-background-grey-light background-color">
                            <div class="columns">
                                <div class="column is-6">
                                    <div class="column content is-normal ">
                                        <p class="block is-size-5"> Sujet : <?php echo $idea->html_subject()?></p>
                                        <p class="block is-size-6"> Texte : <?php echo $idea->html_text()?></p>
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="column content is-normal">
                                        <img class="icon is-medium" src="views/img/etat/<?php echo $idea->status()?>.ico" alt="status-users">
                                        <p class="is-size-6"> <?php echo $this->_db->countLikes($idea->id_idea())?> like(s)</p>
                                        <p class="block is-size-6"><?php echo $idea->html_submitted_date()?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>
        <footer class="modal-card-foot">
        </footer>
    </div>
</div>

<!-- Buttons used to acceed to the modals
<div class="own-action-buttons-container">
    <button class="button is-dark is-medium own-action-buttons background-color" id="launchIdea">Mes postes</button>
    <button class="button is-dark is-medium own-action-buttons background-color" id="lauchComment">Mes commentaires</button>
    <button class="button is-dark is-medium own-action-buttons background-color" id="launchLike">Mes likes</button>
</div>
-->

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
                    <p class="title is-4"><?php echo $_SESSION['username'] ?></p>
                    <p class="subtitle is-6"><?php echo $_SESSION['email'] ?></p>
                    <p class="block is-size-6" style="color: <?php echo $statutColor ?>;"><?php echo $statutName ?></p>
                </div>
            </div>
        </div>

        <div class="column media-right rows">
            <button class="button is-dark is-small is-fullwidth own-info-style" id="launchIdea">Mes postes</button>
            <button class="button is-dark is-small is-fullwidth own-info-style" id="lauchComment">Mes commentaires</button>
            <button class="button is-dark is-small is-fullwidth own-info-style" id="launchLike">Mes likes</button>
        </div>
    </div>
</div>

<!-- Scripts used for the modals -->
<script>
    $("#launchIdea").click(function() {
        $(".modal-idea").addClass("is-active");
    });

    $("#lauchComment").click(function() {
        $(".modal-comment").addClass("is-active");
    });

    $("#launchLike").click(function() {
        $(".modal-like").addClass("is-active");
    });

    $(".delete").click(function() {
        $(".modal").removeClass("is-active");
    });
</script>