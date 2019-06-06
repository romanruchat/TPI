<?php Ob_start(); ?>

<section class="py-5">
    <div class="ErrorMsg"><?=$message?></div>
    <div class="card-body dishesContainer">
        <!-- Affiche les plats -->
        <?php if(!$emptyBasket)
            foreach($_SESSION['dishesSelected'] as $dishSelected) : ?>
                <div class="dishCardBasket">
                    <form action="?action=DeselectDish" method="post">
                        <input hidden id="idDishSelected" name="idDishSelected" value="<?= $dishSelected['idDishes']; ?>"/>
                        <div class="dishName"><?= $dishSelected['Name']; ?></div>
                        <div class="dishPrize"><?= $dishSelected['Prize']; ?>.-</div>
                        <div class="dishDescription"><?= $dishSelected['Description']; ?></div>
                       <div class="dishCount"><?= $dishSelected['count']; ?></div>
                        <div class="dishDelete"><input class="crossImage" type="submit"></div>
                    </form>
                </div>
        <?php endforeach;?>

        <?php if($emptyBasket):?>
            <div class="emptyBasket">Le panier est vide</div>
        <?php else:?>
        <div class="basketSubmitButton">
            <a href="#">
               <button class="btn btn-primary btn-block" name="Confirmation" onClick="confirmation('?action=ConfirmOrder')">Confirmation</button>
            </a>
        </div>
        <?php endif;?>
    </div>
</section>

<?php $contenu = ob_get_clean();?>
<?php require ("Pattern.php");?>



<!-- Script javascript permettant d'ouvrir la boîte de confirmation de suppression de commande -->
<SCRIPT>
    function confirmation() {
        var msg = "Êtes-vous sur de vouloir passer cette commande ?";
        if (confirm(msg)) {
            location.replace("?action=ConfirmOrder");
        }
    }
</SCRIPT>