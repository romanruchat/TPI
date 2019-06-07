<?php
/*

Créateur : Roman Ruchat
Date de création : 04.06.2019
But du fichier : Affichage du formulaire permettant à la modification des plats

*/
?>

<?php Ob_start();  ?>
    <div class="container">
        <div class="card card-register mx-auto mt-5">
            <!-- formulaire  de modification de plat -->
            <div class="card-header">Formulaire de modification de plat</div>
            <div class="card-body">
                <form action="?action=UpdateDish" method="post">
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-9">
                                <div class="form-label-group">
                                    <input hidden id="idDish" name="idDish" value="<?= $data['idDishes']; ?>"/>
                                    <input type="text" id="dishName" name="dishName" class="form-control"  value="<?= $data['Name']; ?>" required="required" autofocus="autofocus"/>
                                    <label for="dishName">Nom du plat</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-label-group">
                                    <input type="number" id="dishPrize" name="dishPrize" class="form-control" min="0" step="0.01" value="<?= $data['Prize']; ?>" required="required">
                                    <label for="dishPrize">Prix</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <textarea type="text" id="dishDescription" name="dishDescription" class="form-control" placeholder="Description"  required="required"><?= $data['Description']; ?></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3">
                            <?php foreach($intos as $into) : ?>
                                    <div>
                                        <label class="checkboxLabel" for="particularity_<?=$into['idParticularities']?>"><?=$into['Name']?></label>
                                        <input type="checkbox" name="particularity_<?=$into['idParticularities']?>"  <?=($into['checked'])?"checked":""?> id="particularity_<?=$into['idParticularities']?>">
                                    </div>
                                <?php endforeach; ?>
                        </div>
                        <div class="col-md-3">
                            <?php foreach($allergies as $allergy) : ?>
                                    <div>
                                        <label class="checkboxLabel" for="particularity_<?=$allergy['idParticularities']?>" ><?=$allergy['Name']?></label>
                                        <input type="checkbox" name="particularity_<?=$allergy['idParticularities']?>" <?=($allergy['checked'])?"checked":""?> id="particularity_<?=$allergy['idParticularities']?>">
                                    </div>
                                <?php endforeach; ?>
                        </div>
                        <div class="col-md-3">
                            <?php foreach($diets as $diet) : ?>
                                    <div>
                                        <label class="checkboxLabel" for="particularity_<?=$diet['idParticularities']?>"><?=$diet['Name']?></label>
                                        <input type="checkbox" name="particularity_<?=$diet['idParticularities']?>"  <?=($diet['checked'])?"checked":""?> id="particularity_<?=$diet['idParticularities']?>">
                                    </div>
                                <?php endforeach; ?>
                        </div>
                    </div>
                    <div><input class="btn btn-primary btn-block" type="submit"  value="Modifier le plat"></div>
                    <div class="ErrorMsg"><?=@$_GET["errorMessage"]?></div>
                </form>
            </div>
        </div>
    </div>

<?php $contenu = ob_get_clean();?>
<?php require ("Pattern.php");?>