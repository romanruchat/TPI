<?php Ob_start();
?>



<section class="py-5">
    <div class="container">
        <div class="card-header dishesHeader">
            <form action="?action=Search" method = "post" class="searchForm">
                <input type="search" name="term" placeholder="Rechercher votre plat">
            </form>
            <div class="dishTitle">Plats</div>
            <a href="?action=Profile">
                <div class="dishesParametersImage"></div>
            </a>
            </div>
        <div class="card-body">
            <div class="form-group">
                <div class="form-row">
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




