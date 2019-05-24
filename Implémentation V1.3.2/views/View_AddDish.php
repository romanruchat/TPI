<?php Ob_start(); ?>
    <div class="container">
        <div class="card card-register mx-auto mt-5">
            <!-- formulaire  d'ajout de plat -->
            <div class="card-header">Formulaire d'ajout de plat</div>
            <div class="card-body">
                <form action="?action=AddDish" method="post">
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
                                    <input type="number" id="dishPrize" name="dishPrize" class="form-control" value="0" required="required">
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
                            <input type="file" id="dishImages" name="dishImages" class="form-control" value="0" accept=".png, .jpeg" multiple />
                            <label for="dishImages">Images</label>
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