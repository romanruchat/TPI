<?php
/*

Créateur : Roman Ruchat
Date de création : 23.05.2019
But du fichier : C'est ici que sont affichés tous les utilisateurs et toutes les spécificités modifiables

*/
?>

<?php Ob_start(); ?>

<!-- Affiche tous les utilisateur-->
<div class="parametersMain">
    <div class="paramsUser">
        <a href="?action=Inscription">
            <input class="paramsButton btn btn-primary btn-block" type="submit" value="Ajouter un utilisateur">
        </a>
        <div class="scrollArea">
        <?php if(isset($users))
        foreach($users as $user) : ?>
            <div class="userData">
                <form action="?action=UserUpdatePage" method="post">
                <input hidden id="idUser" name="idUser" value="<?= $user['idUser']; ?>"/>
                <div><strong>Nom : </strong><?= $user['Name']; ?></div>
                <div><strong>Prénom : </strong><?= $user['First_Name']; ?></div>
                <div><strong>Ville : </strong><?= $user['City']; ?></div>
                <div class="userDataParameters">
                    <input type="submit" class="parametersImage paramSubmitButton">
                </div>
                </form>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
    <!-- Affiche toutes les spécificités-->
    <div class="paramsParticularities">
        <a href="?action=AddParticularityPage">
            <input class="paramsButton btn btn-primary btn-block" type="submit" value="Ajouter une spécificité">
        </a>
        <div class="scrollArea">
            <?php if(isset($particularities))
                foreach($particularities as $particularity) : ?>
            <div class="userData">
                <form action="?action=ParticularityUpdatePage" method="post">
                    <input hidden id="idParticularities" name="idParticularities" value="<?= $particularity['idParticularities']; ?>"/>
                    <div><strong>Nom : </strong><?= $particularity['Name']; ?></div>
                    <div><strong>Type : </strong><?= $particularity['Type']; ?></div>
                    <div class="userDataParameters">
                        <input type="submit" class="parametersImage paramSubmitButton">
                    </div>
                </form>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>


<?php $contenu = ob_get_clean();?>
<?php require ("Pattern.php");?>
