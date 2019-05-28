<?php Ob_start(); ?>

<div class="card-body">
    <div class="form-group">
        <div class="form-row">
            <!-- Affiche les plats -->
            <?php if(isset($dishesSelected))
                foreach($dishesSelected as $dishSelected) : ?>
                    <div class="col-md-3">
                            <div class="form-label-group">
                                <p><strong>Nom : </strong><?= $dishSelected['Name']; ?></p>
                                <p><strong>Prix : </strong><?= $dishSelected['Prize']; ?></p>
                                <p><strong>Description : </strong><?= $dishSelected['Description']; ?></p>
                            </div>
                    </div>
                <?php endforeach ?>
        </div>
    </div>
</div>

<?php $contenu = ob_get_clean();?>
<?php require ("Pattern.php");?>
