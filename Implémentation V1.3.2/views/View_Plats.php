<?php Ob_start();
?>
<!-- <a href="?action=Profile">
    <div class="dishesParametersImage"></div>
</a> -->


<section class="py-5">
    <div class="container">
        <div class="card-header dishesHeader">
            <div class="col-md-4">
                <form action="?action=Search" method = "post" class="searchForm">
                    <input type="search" name="term" placeholder="Rechercher votre plat">
                </form>
            </div>
            <div class="col-md-4">
                <div class="dishTitle">Plats</div>
            </div>
            <div class="col-md-4">
                <a href="?action=AddDishPage">
                <input class="btn btn-primary btn-block" type="submit" value="Ajouter un plat">
                </a>
            </div>
            </div>
        <div class="card-body">
            <div class="form-group">
                <div class="form-row">
                    <!-- Affiche les plats -->
                    <?php if(isset($dishes))
                    foreach($dishes as $dish) : ?>
                            <div class="col-md-3">
                                <form action="?action=AddDishes">
                                    <div class="form-label-group">
                                        <p><strong>Nom : </strong><?= $dish['Name']; ?></p>
                                        <p><strong>Prix : </strong><?= $dish['Prize']; ?></p>
                                        <p><strong>Description : </strong><?= $dish['Description']; ?></p>
                                    </div>

                                    <div><input class="btn btn-primary btn-block" type="submit"  value="Ajouter au panier"></div>
                                </form>
                            </div>
                    <?php endforeach ?>

                </div>
            </div>
        </div>
    </div>
</section>
<?php $contenu = ob_get_clean(); ?>
<?php require ("Pattern.php"); ?>




