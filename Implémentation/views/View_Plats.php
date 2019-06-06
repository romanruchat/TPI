<?php Ob_start();
?>
<!-- <a href="?action=Profile">
    <div class="dishesParametersImage"></div>
</a> -->


<section class="py-5">
    <div class="ErrorMsg"><?=@$_GET["Message"]?></div>
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
        <div class="card-body dishesContainer">
            <!-- Affiche les plats -->
            <?php if(isset($dishes)) :
            foreach($dishes as $dish) : ?>
                    <div class="dishCard">
                        <div class="dishInformations">
                            <form method="get">
                                <input hidden name="action" value="InformationsDishPage"/>
                                <input hidden name="idDish" value="<?= $dish['idDishes']; ?>"/>
                                <input type="submit">
                            </form>
                        </div>
                    <form action="?action=AddDishBasket" method="post">
                        <input hidden id="idDish" name="idDish" value="<?= $dish['idDishes']; ?>"/>
                        <div class="dishName"><?= $dish['Name']; ?></div>
                        <div class="dishImage" style="background-image: url(<?= getDishImg($dish['img']); ?>)"></div>
                        <div class="dishPrize"><?= $dish['Prize']; ?>.-</div>
                        <div class="dishDescription"><?= $dish['Description']; ?></div>
                        <div><input class="btn btn-primary btn-block" type="submit"  value="Ajouter au panier"></div>
                    </form>

                <!-- Affiche les boutons uniquement si l'utilisateur est  administrateur -->
                <?php if (isset($_SESSION['User_Type']) && $_SESSION['User_Type'] == "1") : ?>
                    <div class="dishButtons">
                        <div class="dishUpdate">
                            <form method="get">
                                <input hidden name="action" value="UpdateDishPage"/>
                                <input hidden name="idDish" value="<?= $dish['idDishes']; ?>"/>
                                <input type="submit">
                            </form>
                        </div>
                        <div class="dishDelete">
                            <form action="?action=DeleteDish" method="post">
                                <input hidden id="idDish" name="idDish" value="<?= $dish['idDishes']; ?>"/>
                                <input type="submit" onClick="confirmation()">
                            </form>
                        </div>
                    </div>
                <?php endif; ?>
                </div>
            <?php endforeach; ?>
            <?php endif; ?>
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