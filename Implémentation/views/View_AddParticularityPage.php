<?php Ob_start(); ?>
<div class="container">
    <div class="card card-register mx-auto mt-5">
        <!-- formulaire  d'ajout de spécificité -->
        <div class="card-header">Formulaire d'ajout de spécificité</div>
        <div class="card-body">
            <form action="?action=AddParticularity" method="post">
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <input type="text" id="particularityName" name="particularityName" class="form-control" placeholder="Nom" required="required" autofocus="autofocus"/>
                                <label for="particularityName">Nom de la spécificité</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <div class="form-row">
                                    <input type="radio" id="into" name="particularities" value="intolerance">
                                    <label for="into">Intolérance</label>
                                </div>
                                <div class="form-row">
                                    <input type="radio" id="allergy" name="particularities" value="allergy">
                                    <label for="allergy">Allérgie</label>
                                </div>
                                <div class="form-row">
                                    <input type="radio" id="diet" name="particularities" value="diet">
                                    <label for="diet">régime</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div><input class="btn btn-primary btn-block" type="submit"  value="Ajout de la spécificité"></div>
                <div class="ErrorMsg"><?=@$_GET["errorMessage"]?></div>

            </form>
        </div>
    </div>
</div>
<?php $contenu = ob_get_clean();?>
<?php require ("Pattern.php");?>
