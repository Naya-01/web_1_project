<div class="background-color">
    <section id="contenu">
        <div class="rows">


            <div class="row" id="home-title">
                <h1 class="title is-1">Partage ton idée avec les autres !</h1>
            </div>
            <div class="row" id="home-text">
                <p>Vous désirez m'aider dans le progression de ma chaine youtube ? <br>
                    Alors n'hésitez pas à donner des idées pour l'amélioration de celle-ci !!</p>
            </div>


            <div class="columns">

                <div class="column is-2 zebi">
                    <form action="?action=accueil" method="post" id="form_filter">
                        <p><input type="submit" class="button-width button is-dark off-button" value="Popularité"></p>
                        <p><input type="submit" class="button-width button" value="Croissant"></p>
                        <p><input type="submit" class="button-width button" value="Decroissant"></p>
                        <p><input type="submit" class="button-width button is-dark off-button" value="Status"></p>
                        <p><input type="submit" class="button-width button" value="En cours" id="enCours"></p>
                        <p><input type="submit" class="button-width button" value="Accepter" id="accepter"></p>
                        <p><input type="submit" class="button-width button" value="Refuser" id="refuser"></p>
                        <p><input type="submit" class="button-width button" value="Fermer" id="fermer"></p>
                    </form>
                </div>

                <div class="column"> <!-- debut idée -->
                    <div class="columns" id="rayan">
                        <div class="column is-one-quarter">
                            <!--                        <p>Ajoute une idée</p>-->
                            <a class="button is-link box" href="index.php?action=newIdea">
                                Ajoute une idée
                            </a>
                        </div>
                        <div class="column off-button">
                            <label class="button is-dark box">Liste des idées</label>
                        </div>
                    </div>
                    <div class="rows"> <!--les idées-->

                        <?php foreach ($tabIdeas as $i => $idea){ ?>
                        <div class="row box has-background-grey-light"><!--une idée-->
                            <div class="columns">
                                <div class="column is-2">
                                    <div class="pseudo has-text-black">
                                        <p class="block"><img class="icon" src="views/img/profil.ico"
                                                              alt="picture-user"> <?php echo $this->_db->getUsername($idea->id_user()) ?> </p>
                                        <img class="icon is-medium" src="views/img/etat/<?php echo $idea->status()?>.ico"
                                             alt="status-users">
                                        <p><input class="icon is-medium" type="image" src="views/img/etat/likee.ico"
                                                  alt="like-icon"></p>
                                        <p class="is-size-4"> <?php echo $this->_db->countLikes($idea->id_idea())?></p>
                                    </div>
                                </div>
                                <div class="column is-9">
                                    <div class="sujet">
                                        <h1 class="block title is-size-3"> Sujet : <?php echo $idea->subject()?> like(s)</h1>
                                        <p><?php echo $idea->text()?>

                                        </p>
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="navbar-end">
                                        <a class="button is-link is-small" href="index.php?action=idea">
                                            Repondre
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
</div>
