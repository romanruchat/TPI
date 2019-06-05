<?php Ob_start(); ?>
<div class="container">
    <div class="card card-register mx-auto mt-5">
        <div class="card-header">Formulaire de connexion</div>
        <div class="card-body">
            <!-- Formulaire de connexion -->
            <form action="?action=Login" method="post">
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address" required="required" autofocus="autofocus">
                        <label for="inputEmail">Adresse Email</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required="required">
                        <label for="inputPassword">Mot de Passe</label>
                    </div>
                </div>
                <div><input class="btn btn-primary btn-block" type="submit" value="Se connecter">  </div>
                <div class="Msg"><?=@$_GET["Message"]?></div>
            </form>
        </div>
    </div>
</div>
<?php $contenu = ob_get_clean();?>
<?php require ("Pattern.php");?>