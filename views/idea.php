<section id="contenu">

    <?php if ($idea->status() != "T") { ?>
        <div class="columns background-color "><!--l'idée-->
            <div class="column is-1 ">
                <div class="pseudo has-text-black">
                    <p class="block"><img class="icon" src="views/img/profil.ico"
                                          alt="picture-user"><?php echo $this->_db->getUsername($idea->id_user()) ?></p>
                    <img class="icon is-medium" src="views/img/etat/<?php echo $idea->status() ?>.ico"
                         alt="status-users">
                    <form action="?action=idea&id_idea=<?php echo $idea->html_id_idea() ?>" method="post">
                        <input type="hidden" name="like_id_idea" value="<?php echo $idea->html_id_idea() ?>">
                        <p><input class="icon is-medium" type="image" src="views/img/etat/likee.ico"
                                  alt="like-icon" name="form_like[]"></p>
                    </form>
                    <p class="is-size-4"> <?php echo $this->_db->countLikes($idea->id_idea()) ?> like(s)</p>
                </div>
            </div>
            <div class="column is-9">
                <h1 class="block title is-size-3"> Sujet : <?php echo $idea->html_subject() ?></h1>
                <p>
                    <?php echo $idea->html_text() ?>
                </p>
            </div>
        </div>

        <div class="rows"> <!--comments-->

            <?php foreach ($comments as $i => $comment) { ?>
                <?php if ($idea->html_closed_date() > $comment->html_creation_date() ||$idea->html_closed_date()==null) { ?>
                    <?php $background = "background-color"; ?>
                <?php } else { ?>
                    <?php $background = "has-background-warning"; ?>
                <?php } ?>

                <div class="comments row box <?php echo $background ?>"><!--one comment-->
                    <div class="columns">
                        <div class="column is-2">
                            <div class="pseudo has-text-black">
                                <p class="block"><img class="icon" src="views/img/profil.ico"
                                                      alt="picture-user"><?php echo $this->_db->getUsername($comment->id_user()) ?>
                                </p>
                                <input type="hidden" name="answer_id_user"
                                       value="<?php echo $comment->html_id_user() ?>">
                            </div>
                        </div>
                        <div class="column is-9">
                            <p><?php if($comment->html_disable()==1){ ?>
                                <?php echo "Ce commentaire a été supprimer" ?>
                                <?php }else{?>
                                <?php echo $comment->html_text() ?>
                                <?php }?>
                            </p>

                        </div>
                        <?php if ($comment->id_user() == $_SESSION['id_user']) { ?>
                            <div class="navbar-end">
                                <form action="?action=idea&id_idea=<?php echo $idea->html_id_idea() ?>" method="post">
                                    <input type="hidden" name="comment_idea"
                                           value="<?php echo $comment->html_id_comment() ?>">
                                    <p><input class="button is-danger" type="submit" value="Supprimer"
                                              name="form_delete_comment"></p>
                                </form>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>

        </div>

        <div class="column">
            <?php if ($notification != "") { ?>
                <p class="is-size-3 box has-background-danger notif-home"><?php echo $notification ?></p>
            <?php } ?>
            <p class="has-text-left is-size-3">Répondre</p>
            <div class="row">
                <form action="?action=idea&id_idea=<?php echo $idea->html_id_idea() ?>" method="post">
                    <textarea class="textarea block" name="form_comment"
                              placeholder="Ajouter un commentaire"></textarea>
                    <div class="navbar-end">
                        <label><input class="button is-link " type="submit" value="Répondre" name="form_answer"></label>
                    </div>
                </form>
            </div>
        </div>
    <?php } else { ?>
        <p class="is-size-3 box has-background-danger notif-home">Vous ne pouvez accèder a une idée non traité !!!</p>
    <?php } ?>
</section>