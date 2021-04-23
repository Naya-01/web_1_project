
<section id="contenu">
        <div class="row" id="home-title">
            <h1 class="title is-1">Partage ton idée avec les autres !</h1>
        </div>

    <?php if($condition){ ?>
        <p class="is-size-3 box has-background-danger notif-home"><?php echo  $notification_post ?></p>
    <?php } ?>

        <div class="column" id="form_idea">
            <form action="?action=newIdea" method="post" class="box background-color">
                <div class="rows">
                    <div class="row block">
                        <label class="label is-size-4">Sujet : <input class="button-width input" type="text"
                                                                      name="form_subject"
                                                                      placeholder="Introduisez une suggestion" maxlength="60"> </label>
                    </div>
                    <div class="row block">
                        <textarea class="textarea" name="form_subject_text" placeholder="Description de la suggestion" maxlength="200"></textarea>
                    </div>
                    <div class="column">
                        <div class="navbar-end">
                            <div class="navbar-item">
                                <a class="button is-danger" href="index.php?action=home"> Annuler</a>
                                <label><input class="button is-link" type="submit" value="Poster"
                                              name="form_post_idea"></label>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
