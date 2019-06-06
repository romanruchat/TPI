<?php Ob_start();  ?>
    <!-- Affichage des informations de l'utilisateur -->
    <section class="py-5">
        <div class="container">
            <div class="card-header">Les informations du plat </div>
            <div class="card-body">
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-3">
                            <div class="form-label-group">
                                <p><strong>Nom : </strong><?= $data['Name']; ?></p>
                                <p><strong>Prix </strong><?= $data['Prize']; ?></p>
                                <p><strong>Description : </strong><?= $data['Description']; ?></p>

                            </div>
                        </div>
                        <!-- formulaire de modifications des spécificités du profil utilisateur -->
                        <form action="?action=AddUserParticularities" method="post">
                            <div class="form-row">
                                <div class="col-md-3">
                                    <?php foreach($intos as $into) : ?>
                                        <div>
                                            <label class="checkboxLabel" for="particularity_<?=$into['idParticularities']?>"><?=$into['Name']?></label>
                                            <input type="checkbox" name="particularity_<?=$into['idParticularities']?>"  <?=($into['checked'])?"checked":""?> id="particularity_<?=$into['idParticularities']?>" disabled>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="col-md-3">
                                    <?php foreach($allergies as $allergy) : ?>
                                        <div>
                                            <label class="checkboxLabel" for="particularity_<?=$allergy['idParticularities']?>" ><?=$allergy['Name']?></label>
                                            <input type="checkbox" name="particularity_<?=$allergy['idParticularities']?>" <?=($allergy['checked'])?"checked":""?> id="particularity_<?=$allergy['idParticularities']?>" disabled>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="col-md-3">
                                    <?php foreach($diets as $diet) : ?>
                                        <div>
                                            <label class="checkboxLabel" for="particularity_<?=$diet['idParticularities']?>"><?=$diet['Name']?></label>
                                            <input type="checkbox" name="particularity_<?=$diet['idParticularities']?>"  <?=($diet['checked'])?"checked":""?> id="particularity_<?=$diet['idParticularities']?>" disabled>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

    </section>
<?php $contenu = ob_get_clean(); ?>
<?php require ("Pattern.php"); ?>