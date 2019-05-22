<?php Ob_start();
$number=0; //Comptage de colonnes
?>

<!-- Custom fonts for this template-->
<link href="css/all.min.css" rel="stylesheet" type="text/css">

<!-- Custom styles for this template-->
<link href="css/sb-admin.css" rel="stylesheet">


<form action="?action=Search" method = "post">
    <input type="search" name="term" placeholder="Rechercher votre plat">
</form>



<section class="py-5">
    <div class="container">
        <div class="card-header">Plats</div>
        <div class="card-body">
            <div class="form-group">
                <div class="form-row">
                    <?php if(isset($dishes))
                    foreach($dishes as $dish) : ?>
                        <?php if($number<3) : ?>
                        <div class="col-md-3">
                            <div class="form-label-group">
                                <p><strong>Nom : </strong><?= $dish['Name']; ?></p>
                                <p><strong>Prix : </strong><?= $dish['Prize']; ?></p>
                                <p><strong>Description : </strong><?= $dish['Description']; ?></p>
                            </div>
                        </div>
                    <?php $number++; ?>
                    <?php endif ?>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $contenu = ob_get_clean(); ?>
<?php require ("Pattern.php"); ?>




