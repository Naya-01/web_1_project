
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
                        <p><button type="submit" class="button-width button" value="crescent" name="popularity">Croissant</button></p>
                        <p><button type="submit" class="button-width button" value="uncrescent" name="popularity">Décroissant</button></p>
                        <p><input type="button" class="button-width button is-dark off-button" value="Date"></p>
                        <p><button type="submit" class="button-width button" value="latest" name="date">Récent</button></p>
                        <p><input type="button" class="button-width button is-dark off-button" value="Statut"></p>
                        <p><button type="submit" class="button-width button" value="T" id="submitted" name="form_status">Soumise</button></p>
                        <p><button type="submit" class="button-width button" value="A" id="accepted" name="form_status">Accepté</button></p>
                        <p><button type="submit" class="button-width button" value="R" id="refused" name="form_status">Refusé</button></p>
                        <p><button type="submit" class="button-width button" value="C" id="closed" name="form_status">Fermé</button></p>
                        <p><input type="button" class="button-width button is-dark off-button" value="Limite d'idée"></p>
                        <p><button type="submit" class="button-width button" value="3" name="form_limit">3</button></p>
                        <p><button type="submit" class="button-width button" value="10" name="form_limit">10</button></p>
                        <p><button type="submit" class="button-width button" value="all" name="form_limit">Tout</button></p>
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
                                        <p class="block"><img class="icon" src="<?php echo $tabUser[$i]->html_picture() ?>"
                                                              alt="picture-user"> <?php echo $tabUser[$i]->html_username() ?> </p>
                                        <img class="icon is-medium" src="views/img/state/<?php echo $idea->html_status()?>.ico"
                                             alt="status-users">
                                        <form action="?action=home" method="post">
                                            <input type="hidden" name="like_id_idea" value="<?php echo $idea->html_id_idea()?>">
                                            <p><input class="icon is-medium" type="image" src="views/img/state/like.ico"
                                                      alt="like-icon" name="form_like[]"></p>
                                        </form>
                                        <p class="is-size-4 block"> <?php echo $idea->html_likes()?> like(s)</p>
                                    </div>
                                </div>
                                <div class="column is-9">
                                    <div class="subject">
                                        <h1 class="block title is-size-3"><a href="index.php?action=idea&id_idea=<?php echo $idea->html_id_idea() ?>">Sujet N°<?php echo $i+1 ?>: <?php echo $idea->html_subject()?></a></h1>
                                        <p><?php echo $idea->text()?>

                                        </p>
                                    </div>
                                </div>
                                <div class="rows">
                                    <input type="hidden" name="answer_idea" value="<?php echo $idea->html_id_idea()?>">
                                    <a class="button is-link is-small" href="index.php?action=idea&id_idea=<?php echo $idea->html_id_idea() ?>">
                                           Répondre
                                    </a>
                                    <p> <?php echo $idea->html_submitted_date()?> </p>
                                </div>
                            </div>
                        </div>
                        <?php } ?>


                    </div>
                </div> <!-- end ideas -->

            </div>


        </div>
    </section>

