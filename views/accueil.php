
    <section id="contenu">
        <div class="rows">


            <div class="row" id="home-title">
                <h1 class="title is-1">Partage ton idée avec les autres !</h1>
            </div>
            <div class="row" id="home-text">
                <?php if($notification_like != ""){ ?>
                <p class="box has-background-danger notif-home" ><?php echo $notification_like ?> </p>
                <?php } ?>
                <p>Vous désirez m'aider dans le progression de ma chaine youtube ? <br>
                    Alors n'hésitez pas à donner des idées pour l'amélioration de celle-ci !!</p>
            </div>


            <div class="columns">

                <div class="column is-2 zebi">
                    <form action="?action=accueil" method="post" id="form_filter">
                        <p><input type="submit" class="button-width button is-dark off-button" value="Popularité"></p>
                        <p><input type="submit" class="button-width button" value="Croissant"></p>
                        <p><input type="submit" class="button-width button" value="Décroissant"></p>
                        <p><input type="submit" class="button-width button is-dark off-button" value="Statut"></p>
                        <p><input type="submit" class="button-width button" value="En cours" id="enCours"></p>
                        <p><input type="submit" class="button-width button" value="Accepté" id="accepter"></p>
                        <p><input type="submit" class="button-width button" value="Refusé" id="refuser"></p>
                        <p><input type="submit" class="button-width button" value="Fermé" id="fermer"></p>
                    </form>
                </div>

                <div class="column"> <!-- debut idée -->
                    <div class="columns" id="rayan">
                        <div class="column is-one-quarter">
                            <!--                        <p>Ajoute une idée</p>-->
                            <a class="button is-link box" href="index.php?action=newIdea">
                                Ajouter une idée
                            </a>
                        </div>
                        <div class="column off-button">
                            <label class="button is-dark box">Liste des idées</label>
                        </div>
                    </div>
                    <div class="rows"> <!--les idées-->

                        <?php foreach ($tabIdeas as $i => $idea){ ?>
                        <div class="row box background-color"><!--une idée-->
                            <div class="columns">
                                <div class="column is-2">
                                    <div class="pseudo has-text-black">
                                        <p class="block"><img class="icon" src="views/img/profil.ico"
                                                              alt="picture-user"> <?php echo $this->_db->getUsername($idea->id_user()) ?> </p>
                                        <img class="icon is-medium" src="views/img/etat/<?php echo $idea->html_status()?>.ico"
                                             alt="status-users">
                                        <form action="?action=accueil" method="post">
                                            <input type="hidden" name="like_id_idea" value="<?php echo $idea->html_id_idea()?>">
                                            <p><input class="icon is-medium" type="image" src="views/img/etat/likee.ico"
                                                      alt="like-icon" name="form_like[]"></p>
                                        </form>
                                        <p class="is-size-4"> <?php echo $this->_db->countLikes($idea->id_idea())?> like(s)</p>
                                    </div>
                                </div>
                                <div class="column is-9">
                                    <div class="sujet">
                                        <h1 class="block title is-size-3"> Sujet : <?php echo $idea->html_subject()?></h1>
                                        <p><?php echo $idea->text()?>

                                        </p>
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="navbar-end">
                                        <input type="hidden" name="answer_idea" value="<?php echo $idea->html_id_idea()?>">
                                        <a class="button is-link is-small" href="index.php?action=idea&id_idea=<?php echo $idea->html_id_idea() ?>">
                                            Répondre
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>


                    </div>
                </div> <!-- fin idée -->

            </div>


        </div>
    </section>

