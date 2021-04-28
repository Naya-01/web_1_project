
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

                <div class="column is-2">
                    <form action="?action=home" method="post" id="form_filter">
                        <p><input type="button" class="button-width button is-dark off-button" value="Popularité"></p>
                        <p><input type="submit" class="button-width button" value="Croissant" name="croissant"></p>
                        <p><input type="submit" class="button-width button" value="Décroissant" name="decroissant"></p>
                        <p><input type="button" class="button-width button is-dark off-button" value="Statut"></p>
                        <p><input type="submit" class="button-width button" value="Accepté" id="accepted" name="form_accepted"></p>
                        <p><input type="submit" class="button-width button" value="Refusé" id="refused" name="form_refused"></p>
                        <p><input type="submit" class="button-width button" value="Fermé" id="closed" name="form_closed"></p>
                        <p><input type="button" class="button-width button is-dark off-button" value="Limite d'idée"></p>
                        <p><input type="submit" class="button-width button" value="3" name="form_3"></p>
                        <p><input type="submit" class="button-width button" value="10" name="form_10"></p>
                        <p><input type="submit" class="button-width button" value="Tout" name="form_all"></p>
                    </form>
                </div>

                <div class="column"> <!-- Start ideas -->
                    <div class="columns">
                        <div class="column is-one-quarter">
                            <a class="button is-link box" href="index.php?action=newIdea">
                                Ajouter une idée
                            </a>
                        </div>
                        <div class="column off-button">
                            <label class="button is-dark box">Liste des idées</label>
                        </div>
                    </div>
                    <div class="rows"> <!--the ideas-->

                        <?php foreach ($tabIdeas as $i => $idea){ ?>
                        <div class="row box background-color"><!--a idea-->
                            <div class="columns">
                                <div class="column is-2">
                                    <div class="nickname has-text-black">
                                        <p class="block"><img class="icon" src="<?php echo DEFAULT_PROFILE_PIC ?>"
                                                              alt="picture-user"> <?php echo $tabUsers[$i] ?> </p>
                                        <img class="icon is-medium" src="views/img/state/<?php echo $idea->html_status()?>.ico"
                                             alt="status-users">
                                        <form action="?action=home" method="post">
                                            <input type="hidden" name="like_id_idea" value="<?php echo $idea->html_id_idea()?>">
                                            <p><input class="icon is-medium" type="image" src="views/img/state/like.ico"
                                                      alt="like-icon" name="form_like[]"></p>
                                        </form>
                                        <p class="is-size-4 block"> <?php echo $tabLikes[$i]?> like(s)</p>
                                    </div>
                                </div>
                                <div class="column is-9">
                                    <div class="subject">
                                        <h1 class="block title is-size-3"> Sujet N°<?php echo $i+1 ?>: <?php echo $idea->html_subject()?></h1>
                                        <p><?php echo $idea->text()?>

                                        </p>
                                    </div>
                                </div>
                                <div class="rows">
                                    <input type="hidden" name="answer_idea" value="<?php echo $idea->html_id_idea()?>">
                                    <a class="button is-link is-small" href="index.php?action=idea&id_idea=<?php echo $idea->html_id_idea() ?>">
                                           Répondre
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php } ?>


                    </div>
                </div> <!-- end ideas -->

            </div>


        </div>
    </section>

