<?php Ob_start();  ?>
    <div class="container">
        <div class="card card-register mx-auto mt-5">
            <!-- formulaire  d'ajout de plat -->
            <div class="card-header">Formulaire d'ajout de plat</div>
            <div class="card-body">
                <form action="?action=AddDish" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-9">
                                <div class="form-label-group">
                                    <input type="text" id="dishName" name="dishName" class="form-control"  required="required" autofocus="autofocus"/>
                                    <label for="dishName">Nom du plat</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-label-group">
                                    <input type="number" id="dishPrize" name="dishPrize" class="form-control" value="0" min="0" step="0.01" required="required">
                                    <label for="dishPrize">Prix</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <textarea type="text" id="dishDescription" name="dishDescription" class="form-control" placeholder="Description"  required="required"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="file" id="dishImages" name="dishImages[]" class="form-control" value="0" accept="image/jpeg, image/png" multiple required/>
                            <label for="dishImages">Images</label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3">
                            <?php if (isset($intos))
                                foreach($intos as $into) : ?>
                                    <div>
                                        <label class="checkboxLabel" for="particularity_<?=$into['idParticularities']?>"><?=$into['Name']?></label>
                                        <input type="checkbox" name="particularity_<?=$into['idParticularities']?>" id="particularity_<?=$into['idParticularities']?>">
                                    </div>
                                <?php endforeach; ?>
                        </div>
                        <div class="col-md-3">
                            <?php if (isset($allergies))
                                foreach($allergies as $allergy) : ?>
                                    <div>
                                        <label class="checkboxLabel" for="particularity_<?=$allergy['idParticularities']?>" ><?=$allergy['Name']?></label>
                                        <input type="checkbox" name="particularity_<?=$allergy['idParticularities']?>" id="particularity_<?=$allergy['idParticularities']?>">
                                    </div>
                                <?php endforeach; ?>
                        </div>
                        <div class="col-md-3">
                            <?php if (isset($diets))
                                foreach($diets as $diet) : ?>
                                    <div>
                                        <label class="checkboxLabel" for="particularity_<?=$diet['idParticularities']?>"><?=$diet['Name']?></label>
                                        <input type="checkbox" name="particularity_<?=$diet['idParticularities']?>" id="particularity_<?=$diet['idParticularities']?>">
                                    </div>
                                <?php endforeach; ?>
                        </div>
                    </div>
                    <div><input class="btn btn-primary btn-block" type="submit"  value="Ajouter le plat"></div>
                    <div class="ErrorMsg"><?=@$_GET["errorMessage"]?></div>
                </form>
            </div>
        </div>
    </div>

<?php $contenu = ob_get_clean();?>
<?php require ("Pattern.php");?>