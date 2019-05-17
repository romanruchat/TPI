<?php Ob_start();
$rows=0; //Comptage de colonnes
?>

<section class="py-5">
    <div class="container">
        <div class="card-header">Plats</div>
        <?php foreach ($dishes as $dish) : ?>
        <?php if($rows<2) : ?>
        <div class="card-body">
            <div class="col-md-">
                <div class="form-label-group">
                    <p><strong>Nom : </strong><?= $dish['Name']; ?></p>
                    <p><strong>Prix : </strong><?= $dish['Prize']; ?></p>
                    <p><strong>Description : </strong><?= $dish['Description']; ?></p>
                </div>
            </div>
            <?php  endif;
            $rows++; ?>
            <?php endforeach ?>
        </div>
    </div>
</section>
<?php $contenu = ob_get_clean(); ?>
<?php require ("Pattern.php"); ?>
