
<!-- Basic informations -->
<div class="gestion_user_title">
    <h1 class="title">Profil</h1>
</div>


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
    </div>
</div>


<div class="columns is-mobile button-width">
    <a class="button column is-info is-light <?php if ($isPost) echo "is-active"?>" href="index.php?action=profil&category=post">Mes postes</a>
    <a class="button column is-info is-light <?php if ($isLike) echo "is-active"?>" href="index.php?action=profil&category=like">Mes likes</a>
    <a class="button column is-info is-light <?php if ($isComment) echo "is-active"?>" href="index.php?action=profil&category=comment">Mes commentaires</a>
</div>

    <div class="gestion_user_block">
        <div class="gestion_own_info_block">
            <?php foreach ($tab as $i => $element){ ?>
                <div class="row box has-background-grey-light background-color">
                    <div class="columns">
                        <div class="column is-6">
                            <div class="column content is-normal ">
                                <?php if ($isComment) { $idea = $this->_db->select_idea($element->id_idea())  ?>
                                    <p class="block is-size-5"> Sujet : <?php echo $idea->html_subject()?></p>
                                    <p class="block is-size-6"> Texte : <?php echo $idea->html_text()?></p>
                                <?php } else { ?>
                                    <p class="block is-size-5"> Sujet : <?php echo $element->html_subject()?></p>
                                    <p class="block is-size-6"> Texte : <?php echo $element->html_text()?></p>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="column">
                            <div class="column content is-normal">
                                <?php if ($isComment) { ?>
                                    <p class="block is-size-6">Commentaire : <?php echo $element->html_text()?></p>
                                    <p class="block is-size-6"><?php echo $element->creation_date()?></p>
                                <?php } else { ?>
                                    <img class="icon is-medium" src="views/img/etat/<?php echo $element->status()?>.ico" alt="status-users">
                                    <p class="is-size-6"> <?php echo $this->_db->countLikes($element->id_idea())?> like(s)</p>
                                    <p class="block is-size-6"><?php echo $element->html_submitted_date()?></p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>