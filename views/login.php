<div class="background-image">

    <section id="contenu">
        <div class="columns" id="forms-c-r">
            <div class="column is-one-third">
                <div id="register-form" class="box has-background-warning">
                    <p class="title is-2">Inscription</p>
                    <form action="?action=login" id="register" method="post">
                        <p class="has-text-black">Email</p>
                        <p class="block"> <input class="input" type="email" size="25" name="email_register" placeholder="Email"></p>
                        <p class="has-text-black">Pseudo</p>
                        <p class="block"><input class="input" type="text" size="25" name="username_register" placeholder="Username"></p>
                        <p class="has-text-black">Mot de passe</p>
                        <p class="block "><input class="input" type="password" size="25" name="password_register" placeholder="*******"></p>
                        <p><input type="submit" class="button is-dark" name="form_register" value="Inscription" id="logo-register"></p>
                    </form>
                </div>
            </div>
            <?php if($condition){ ?>
            <div class="box" id="notif-login">
                <div class="field">
                    <p class="has-text-black"><?php echo $notification ?></p>
                </div>
            </div>

            <?php }?>

            <div class="column is-one-third">
                <div  id="connexion-form" class="box has-background-info">
                    <p class="title is-2">Connexion</p>
                    <form id="connexion" action="?action=login" method="post">
                        <p class="has-text-black">Email</p>
                        <p class="block"><input  class="input" type="text"  name="email_login" placeholder="Email"></p>
                        <p class="has-text-black">Mot de passe</p>
                        <p class="block"><input class="input" type="password" name="password_login" placeholder="*******"></p>
                        <p><input type="submit" class="button is-dark" name="form_login" value="Connexion" ></p>
                    </form>
                </div>
            </div>
        </div>


    </section>
</div>
