<?php Ob_start(); ?>


<div class="parametersMain">

    <div class="scrollArea">
    <?php if(isset($users))
    foreach($users as $user) : ?>
        <div class="userData">
            <form action="?action=UserUpdate" method="post">
            <input hidden id="idUser" name="idUser" value="<?= $user['idUser']; ?>"/>
            <div><strong>Nom : </strong><?= $user['Name']; ?></div>
            <div><strong>Prénom : </strong><?= $user['First_Name']; ?></div>
            <div><strong>Ville : </strong><?= $user['City']; ?></div>
            <div class="userDataParameters">
                <div ><input type="submit" class="parametersImage"> </div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
<div class="scrollArea">
    <?php if(isset($particularities))
        foreach($particularities as $particularity) : ?>
            <div class="userData">
                <div><strong>Nom : </strong><?= $particularity['Name']; ?></div>
                <div><strong>Type : </strong><?= $particularity['Type']; ?></div>
                <div class="userDataParameters">
                    <a class="nav-link" href="?action=ParticularityUpdate">
                        <div class="parametersImage"></div>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
</div>
</div>


<?php $contenu = ob_get_clean();?>
<?php require ("Pattern.php");?>
