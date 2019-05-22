<?php Ob_start(); ?>



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
                    <form action="?action=Profile" method="post">
                        <div class="col-md-3">
                            <div class="form-label-group">
                                <input type="checkbox" name="intolerance[]"  class="form-control" id="color">
                                <input type="checkbox" name="intolerance[]" value="13" class="form-control" id="scales">
                                <input type="checkbox" name="intolerance[]" value="14" class="form-control" id="scales">
                                <input type="checkbox" name="intolerance[]" value="15" class="form-control" id="scales">
                                <input type="submit"/>
                                <label for="scales">Scales</label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div><a href="?action=Removal"><input type="submit" value="Supprimer votre compte"></a></div>
</section>
<?php var_dump($_POST); ?>
<?php $contenu = ob_get_clean();?>
<?php require ("Pattern.php");?>
