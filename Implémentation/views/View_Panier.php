<?php Ob_start(); ?>

<div class="card-body">
    <div class="form-group">
        <div class="form-row">
            <!-- Affiche les plats -->
            <?php if(isset($_SESSION['dishesSelected']))
                foreach($_SESSION['dishesSelected'] as $dishSelected) : ?>
                    <div class="col-md-3">
                        <form action="?action=DeselectDish" method="post">
                            <div class="form-label-group">
                                <input hidden id="idDishSelected" name="idDishSelected" value="<?= $dishSelected['idDishes']; ?>"/>
                                <p><strong>Nom : </strong><?= $dishSelected['Name']; ?></p>
                                <p><strong>Prix : </strong><?= $dishSelected['Prize']; ?></p>
                                <p><strong>Description : </strong><?= $dishSelected['Description']; ?></p>
                                <div><input class="crossImage" type="submit"></div>
                            </div>
                        </form>
                    </div>
                <?php endforeach ?>
            <a href="#">
                <div class="btn btn-primary btn-block" onClick="confirmation()" name="Confirmation"> <label for="Confirmation">Confirmation</label></div>
            </a>
        </div>
    </div>
</div>

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