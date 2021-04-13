<section id="contenu">
    <div class="columns background-color "><!--l'idée-->
        <div class="column is-1 ">
            <div class="pseudo has-text-black">
                <p class="block"><img class="icon" src="views/img/profil.ico"
                                      alt="picture-user"><?php echo $this->_db->getUsername($idea->id_user()) ?></p>
                <img class="icon is-medium" src="views/img/etat/<?php echo $idea->status()?>.ico"
                     alt="status-users">
                <form action="?action=idea&id_idea=<?php echo $idea->id_idea() ?>" method="post">
                    <input type="hidden" name="like_id_idea" value="<?php echo $idea->id_idea()?>">
                    <p><input class="icon is-medium" type="image" src="views/img/etat/likee.ico"
                              alt="like-icon" name="form_like[]"></p>
                </form>
                <p class="is-size-4"> <?php echo $this->_db->countLikes($idea->id_idea())?> like(s)</p>
            </div>
        </div>
        <div class="column is-9">
            <h1 class="block title is-size-3"> Sujet : <?php echo $idea->subject()?></h1>
            <p>
                <?php echo $idea->text()?>
            </p>
        </div>
        <div class="column">
            <div class="navbar-end">
                <a class="button is-link is-small" href="index.php?action=idea&id_idea=<?php echo $idea->id_idea() ?>">
                    Repondre
                </a>
            </div>
        </div>
    </div>

    <div class="rows"> <!--comments-->
        <div class="comments row box background-color"><!--one comment-->
            <div class="columns">
                <div class="column is-1">
                    <div class="pseudo has-text-black">
                        <p class="block"><img class="icon" src="views/img/profil.ico" alt="picture-user">Rayan</p>
                    </div>
                </div>
                <div class="column is-9">
                    <p>Vous désirez m'aider dans la progression de ma chaine youtube ?
                        Alors n'hésitez pas à donner des idées pour l'amélioration de ma
                        chaine.
                        Ma chaine Youtube est orientée dans le multigaming et le
                        divertissement.
                        La meilleure idée se verra attribuer une récompense!!</p>
                </div>
            </div>
        </div>

        <div class="comments row box background-color"><!--one comment-->
            <div class="columns">
                <div class="column is-1">
                    <div class="pseudo has-text-black">
                        <p class="block"><img class="icon" src="views/img/profil.ico" alt="picture-user">Rayan</p>
                    </div>
                </div>
                <div class="column is-9">
                    <p>Vous désirez m'aider dans la progression de ma chaine youtube ?
                        Alors n'hésitez pas à donner des idées pour l'amélioration de ma
                        chaine.
                        Ma chaine Youtube est orientée dans le multigaming et le
                        divertissement.
                        La meilleure idée se verra attribuer une récompense!!</p>
                </div>
            </div>
        </div>


    </div>

    <div class="column">
        <p class="has-text-left is-size-3">Repondre</p>
        <div class="row">
            <form action="?action=idea" method="post">
                <textarea class="textarea block" name="form_comment" placeholder="ajoute un commentaire"></textarea>
                <div class="navbar-end">
                    <label><input class="button is-link " type="submit" value="Repondre" name="form_answer"></label>
                </div>
            </form>
        </div>
    </div>

</section>