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
            <!-- Affiche les boutons uniquement si l'utilisateur est  administrateur -->
            <?php if (isset($_SESSION['User_Type']) && $_SESSION['User_Type'] == "1") : ?>
            <div class="col-md-4">
                <a href="?action=AddDishPage">
                    <input class="btn btn-primary btn-block" type="submit" value="Ajouter un plat">
                </a>
            </div>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <div class="form-group">
                <div class="form-row">
                    <!-- Affiche les plats -->
                    <?php if(isset($dishes))
                    foreach($dishes as $dish) : ?>
                            <div class="col-md-3">
                                <form action="?action=AddDishBasket" method="post">
                                    <div class="form-label-group">
                                        <input hidden id="idDish" name="idDish" value="<?= $dish['idDishes']; ?>"/>
                                        <p><strong>Nom : </strong><?= $dish['Name']; ?></p>
                                        <p><strong>Prix : </strong><?= $dish['Prize']; ?></p>
                                        <div class=""><img src="<?= $dish['img']; ?>"/></div>
                                        <p><strong>Description : </strong><?= $dish['Description']; ?></p>
                                    </div>
                                    <div><input class="btn btn-primary btn-block" type="submit"  value="Ajouter au panier"></div>
                                </form>
                                <!-- Affiche les boutons uniquement si l'utilisateur est  administrateur -->
                                <?php if (isset($_SESSION['User_Type']) && $_SESSION['User_Type'] == "1") : ?>
                                    <form action="?action=DeleteDish" method="post">
                                        <input hidden id="idDish" name="idDish" value="<?= $dish['idDishes']; ?>"/>
                                        <div><input class="crossImage" type="submit" onClick="confirmation()"></div>
                                    </form>
                                <?php endif; ?>
                            </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $contenu = ob_get_clean(); ?>
<?php require ("Pattern.php"); ?>


<!-- Script javascript permettant d'ouvrir la boîte de confirmation de suppression du plat -->
<SCRIPT>
    function confirmation() {
        var msg = "Êtes-vous sur de vouloir supprimer le plat ?";
        if (confirm(msg))
            location.replace("?action=DeleteDish");
    }
</SCRIPT>


