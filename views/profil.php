
<!-- Basic informations -->
<div class="has-text-centered mt-5">
    <h1 class="title">Profil</h1>
</div>

<div class="card card-profile">
    <div class="card-content">
        <div class="media">
            <div class="media-left">
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

<nav class="navbar is-transparent">
    <div id="navbarExampleTransparentExample" class="navbar-menu">
        <div class="navbar-start" style="flex-grow: 1; justify-content: center;">
            <a class="navbar-item <?php if ($isPost) echo "is-active"?>" href="index.php?action=profil&category=post">
                Mes postes
            </a>
            <a class="navbar-item <?php if ($isLike) echo "is-active"?>" href="index.php?action=profil&category=like">
                Mes likes
            </a>
            <a class="navbar-item <?php if ($isComment) echo "is-active"?>" href="index.php?action=profil&category=comment">
                Mes commentaires
            </a>
        </div>
    </div>
</nav>

<?php foreach ($tab as $i => $element){

    if (!$isComment) {
        $statut = $element->html_status();
        $subject = $element->html_subject();
        $text = $element->html_text();
        $date = $element->html_submitted_date();
    } else {
        $idea = $this->_db->select_idea($element->id_idea());
        $statut = $idea->html_status();
        $subject = $idea->html_subject();
        $text = "Message : " . $idea->html_text();
        $date = $element->creation_date();
        $comment = "Commentaire : " . $element->html_text();
    }

    if ($isComment) {
        $user = $this->_db->getUsername($idea->id_user());
    } else if ($isLike)  {
        $user = $this->_db->getUsername($element->id_user());
    } else {
        $user = "you";
    }
    ?>

    <div class="card card-profile">
        <div class="card-content">
            <div class="media">
                <div class="media-left">
                    <figure class="image is-48x48">
                        <img src="views/img/etat/<?php echo $statut ?>.ico" alt="Placeholder image">
                    </figure>
                </div>
                <div class="media-content">
                    <p class="title is-4"><?php echo $subject ?></p>
                    <p class="subtitle is-6">By <?php echo $user ?></p>
                </div>
            </div>

            <div class="content">
                <?php echo $text ?>
                <?php if ($isComment) { ?>
                    <br>
                    <?php echo $comment ?>
                <?php } ?>
                <br>
                <time datetime="2016-1-1"><strong><?php echo $date ?></strong></time>
            </div>
        </div>
    </div>
<?php } ?>