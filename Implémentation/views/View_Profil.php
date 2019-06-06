<?php Ob_start(); ?>


<!-- Affichage des informations de l'utilisateur -->
<section class="py-5">
    <div class="container">
        <div class="card-header">Vos informations</div>
        <div class="card-body">
            <div class="form-group">
                <div class="form-row">
                    <div class="col-md-3">
                        <div class="form-label-group">
                            <p><strong>Nom : </strong><?= $data['Name']; ?></p>
                            <p><strong>Prénom : </strong><?= $data['First_Name']; ?></p>
                            <p><strong>Email : </strong><?= $data['Email']; ?>
                            <p><strong>Rue : </strong><?= $data['Street']; ?></p>
                            <p><strong>Numéro de rue : </strong><?= $data['Street_Number']; ?></p>
                            <p><strong>Code postal : </strong><?= $data['Postcode']; ?></p>
                            <p><strong>Ville : </strong><?= $data['City']; ?></p>
                            <p><strong>Etage: </strong><?= $data['Floor_Number']; ?></p>
                        </div>
                    </div>
                    <!-- formulaire de modifications des spécificités du profil utilisateur -->
                        <form action="?action=AddUserParticularities" method="post">
                                <div class="form-row">
                                    <div class="col-md-3">
                                        <?php if (isset($intos))
                                            foreach($intos as $into) : ?>
                                                <div>
                                                    <label class="checkboxLabel" for="particularity_<?=$into['idParticularities']?>"><?=$into['Name']?></label>
                                                    <input type="checkbox" name="particularity_<?=$into['idParticularities']?>"  <?=($into['checked'])?"checked":""?> id="particularity_<?=$into['idParticularities']?>">
                                                </div>
                                            <?php endforeach; ?>
                                    </div>
                                        <div class="col-md-3">
                                            <?php if (isset($allergies))
                                                foreach($allergies as $allergy) : ?>
                                                    <div>
                                                        <label class="checkboxLabel" for="particularity_<?=$allergy['idParticularities']?>" ><?=$allergy['Name']?></label>
                                                        <input type="checkbox" name="particularity_<?=$allergy['idParticularities']?>" <?=($allergy['checked'])?"checked":""?> id="particularity_<?=$allergy['idParticularities']?>">
                                                    </div>
                                                <?php endforeach; ?>
                                        </div>
                                        <div class="col-md-3">
                                            <?php if (isset($diets))
                                                foreach($diets as $diet) : ?>
                                                    <div>
                                                        <label class="checkboxLabel" for="particularity_<?=$diet['idParticularities']?>"><?=$diet['Name']?></label>
                                                        <input type="checkbox" name="particularity_<?=$diet['idParticularities']?>"  <?=($diet['checked'])?"checked":""?> id="particularity_<?=$diet['idParticularities']?>">
                                                    </div>
                                                <?php endforeach; ?>
                                        </div>
                                </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <input class="btn btn-primary btn-block" type="submit"  value="Modifier mes données">
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-primary btn-block" type="button" onclick="confirmation('?action=Removal&idUser=<?= $_SESSION['loggedUser']; ?>')">Supprimer le compte</button>
                                    </div>
                                </div>
                            </div>
                        </form>
            </div>
        </div>
    </div>

</section>
<?php $contenu = ob_get_clean();?>
<?php require ("Pattern.php");?>

<!-- Script javascript permettant d'ouvrir la boîte de confirmation de suppression de compte -->
<SCRIPT>
    function confirmation(redirect) {
        console.log(redirect);
        var msg = "Êtes-vous sur de vouloir supprimer le compte ?";
        if (confirm(msg)) {
            location.replace(redirect);
        }
    }
</SCRIPT>