<div class="has-text-centered mt-5">
    <h1 class="title">Profil</h1>
</div>

<!-- Notification -->
<?php if (!empty($notification)) { ?>
    <div class="notification is-info is-light notification-handling">
        <?php echo $notification ?>
    </div>
<?php } ?>

<!-- Profile card -->
<div class="card card-theme blue-gradient-color">
    <div class="card-content">
        <div class="media">
            <div class="media-left">
                <figure class="image is-48x48">
                        <img class="is-rounded" src="<?php echo $_SESSION['image'] ?>" alt="Profile image">
                </figure>
            </div>
            <div class="media-content">
                <p class="title is-4"><?php echo $_SESSION['username'] ?></p>
                <p class="subtitle is-6"><?php echo $_SESSION['email'] ?></p>
                <p class="block is-size-6" style="color: <?php echo $statutColor ?>;"><?php echo $statutName ?></p>
            </div>
        </div>
        <form enctype="multipart/form-data" action="index.php?action=profil" method="post">
            <div class="file navbar-end is-small">
                <label class="file-label">
                    <input class="file-input" type="file" name="userfile">
                    <span class="file-cta">
                        <span class="file-icon"><img src="<?php echo VIEWS_PATH ?>img/upload.png" alt="Upload image"></span>
                        <span class="file-label">Changer de photo...</span>
                    </span>
                </label>
                <input class="button is-small ml-1" type="submit" name="userfile" value="Soumettre">
            </div>
        </form>
    </div>
</div>

<!-- Profile tabs -->
<div class="tabs is-centered mb-4">
    <ul>
        <li class="<?php if ($isPost) echo "is-active"?>">
            <a class="navbar-item" href="index.php?action=profil&category=post">
                Mes postes
            </a>
        </li>
        <li class="<?php if ($isLike) echo "is-active"?>">
            <a href="index.php?action=profil&category=like">
                Mes likes
            </a>
        </li>
        <li class="<?php if ($isComment) echo "is-active"?>">
            <a href="index.php?action=profil&category=comment">
                Mes commentaires
            </a>
        </li>
    </ul>
</div>

<!-- Display of requested content -->
<?php foreach ($tab as $i => $element){

    # Definition of variables for each ideas/comments
    if (!$isComment) {
        $statut = $element->html_status();
        $subject = $element->html_subject();
        $text = $element->html_text();
        $date = $element->html_submitted_date();
    } else {
        $idea = $this->_db->select_idea($element->id_idea());
        $statut = $idea->html_status();
        $subject = $idea->html_subject();
        $text = $idea->html_text();
        $date = $element->creation_date();
        $comment = $element->html_text();
    }

    if ($isComment) {
        $user = $this->_db->getUsername($idea->id_user());
    } else if ($isLike)  {
        $user = $this->_db->getUsername($element->id_user());
    } else {
        $user = "you";
    }
    ?>

    <div class="card card-theme">
        <div class="card-content">
            <div class="media">
                <div class="media-left">
                    <figure class="image is-48x48">
                        <img src="<?php echo VIEWS_PATH ?>img/etat/<?php echo $statut ?>.ico" alt="Placeholder image">
                    </figure>
                </div>
                <div class="media-content">
                    <p class="title is-4"><?php echo $subject ?></p>
                    <p class="subtitle is-6">By <?php echo $user ?></p>
                </div>
            </div>
            <div class="content">
                <strong>Message : </strong><?php echo $text ?>
                <?php if ($isComment) { ?>
                    <br>
                    <strong>Commentaire : </strong><?php echo $comment ?>
                <?php } ?>
                <br>
                <time datetime="2011-11-18T14:54:39.929"><strong><?php echo $date ?></strong></time>
            </div>
        </div>
    </div>
<?php } ?>