<!-- Page title -->
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
                        <img class="is-rounded" src="<?php echo $localUser['image'] ?>" alt="Profile image">
                </figure>
            </div>
            <div class="media-content">
                <p class="title is-4"><?php echo $localUser['username'] ?></p>
                <p class="subtitle is-6"><?php echo $localUser['email'] ?></p>
                <p class="block is-size-6 <?php echo $localUser['status_color'] ?>">
                    <?php echo $localUser['status_name'] ?>
                </p>
            </div>
        </div>
        <form enctype="multipart/form-data" action="index.php?action=profile" method="post">
            <div class="file navbar-end is-small">
                <label class="file-label">
                    <input class="file-input" type="file" name="userfile">
                    <span class="file-cta">
                        <span class="file-icon"><img src="<?php echo VIEWS_PATH ?>img/upload.png" alt="Upload image"></span>
                        <span class="file-label">Changer de photo...</span>
                    </span>
                </label>
                <input class="button is-small ml-1" type="submit" name="userfile">
            </div>
        </form>
    </div>
</div>

<!-- Profile tabs -->
<div class="tabs is-centered mb-4">
    <ul>
        <li class="<?php if (!empty($isPost)) echo "is-active"?>">
            <a href="index.php?action=profile&category=post">
                Mes postes
            </a>
        </li>
        <li class="<?php if (!empty($isLike)) echo "is-active"?>">
            <a href="index.php?action=profile&category=like">
                Mes likes
            </a>
        </li>
        <li class="<?php if (!empty($isComment)) echo "is-active"?>">
            <a href="index.php?action=profile&category=comment">
                Mes commentaires
            </a>
        </li>
    </ul>
</div>

<!-- Display of requested content -->
<?php foreach ($profileTab as $i => $element) { ?>
    <div class="card card-theme">
        <div class="card-content">
            <div class="media">
                <div class="media-left">
                    <figure class="image is-48x48">
                        <img src="<?php echo VIEWS_PATH ?>img/state/<?php echo $profileTab[$i]['status'] ?>.ico" alt="Status icon">
                    </figure>
                </div>
                <div class="media-content">
                    <p class="title is-4"><?php echo $profileTab[$i]['subject'] ?></p>
                    <p class="subtitle is-6">By <?php echo $profileTab[$i]['user'] ?></p>
                </div>
            </div>
            <div class="content">
                <strong>Message : </strong><?php echo $profileTab[$i]['text'] ?>
                <?php if ($isComment) { ?>
                    <br>
                    <strong>Commentaire : </strong><?php echo $profileTab[$i]['comment'] ?>
                <?php } ?>
                <br>
                <strong><?php echo $profileTab[$i]['date'] ?></strong>
            </div>
            <?php if ($isComment) { ?>
                <div class="buttons has-addons navbar-end">
                    <form class="buttons are-medium" action="index.php?action=profile&category=comment" method="post">
                        <input type="hidden" name="comment-id" value="<?php echo $profileTab[$i]['id_comment']?>">
                        <input class="button is-danger is-light is-small" name="form-delete-comment" type="submit" value="Supprimer">
                    </form>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>