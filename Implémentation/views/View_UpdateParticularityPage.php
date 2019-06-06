<?php Ob_start(); ?>

<div class="container">
    <div class="card card-register mx-auto mt-5">
        <!-- formulaire  d'ajout de spécificité -->
        <div class="card-header">Formulaire d'ajout de spécificité</div>
        <div class="card-body">
            <form action="?action=UpdateParticularity" method="post">
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <input hidden id="idParticularities" name="idParticularities" value="<?= $data['idParticularities']; ?>"/>
                                <input type="text" id="particularityName" name="particularityName" class="form-control" placeholder="Nom" value="<?= $data['Name']; ?>" required="required" autofocus="autofocus"/>
                                <label for="particularityName">Nom de la spécificité</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <div class="form-row">
                                    <input type="radio" id="into" name="particularities" value="Intolérance"  <?php if($data['Type'] == 'Intolérance'){
                                    echo 'checked="checked" ';
                                    }
                                    ?>/>
                                    <label for="into">Intolérance</label>
                                </div>
                                <div class="form-row">
                                    <input type="radio" id="allergy" name="particularities" value="Allergie" <?php if($data['Type'] == 'Allergie'){
                                        echo 'checked="checked" ';
                                    }
                                    ?>/>
                                    <label for="allergy">Allérgie</label>
                                </div>
                                <div class="form-row">
                                    <input type="radio" id="diet" name="particularities" value="Régime" <?php if($data['Type'] == 'Régime'){
                                        echo 'checked="checked" ';
                                    }
                                    ?>/>
                                    <label for="diet">régime</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div><input class="btn btn-primary btn-block" type="submit"  value="Modification de la spécificité"></div>
                        </div>
                        <div class="col-md-6">
                        <button class="btn btn-primary btn-block" type="button" onclick="confirmation('?action=DeleteParticularity&idParticularities=<?= $data['idParticularities']; ?>')">Supprimer la spécificité</button>
                        </div>
                        <div class="ErrorMsg"><?=@$_GET["errorMessage"]?></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $contenu = ob_get_clean(); ?>
<?php require ("Pattern.php"); ?>


<!-- Script javascript permettant d'ouvrir la boîte de confirmation de suppression de la spécificité -->
<SCRIPT>
    function confirmation(redirect) {
        console.log(redirect);
        var msg = "Êtes-vous sur de vouloir supprimer la spécificité ?";
        if (confirm(msg)) {
            location.replace(redirect);
        }

    }
</SCRIPT>