<?php Ob_start(); ?>

<div class="card-body">
    <div class="form-group">
        <div class="form-row">
            <!-- Affiche les plats -->
            <?php if(isset($_SESSION['dishesSelected']))
                foreach($_SESSION['dishesSelected'] as $dishSelected) : ?>
                    <div class="col-md-3">
                        <form action="?action=ConfirmOrder" method="post">
                            <div class="form-label-group">
                                <p><strong>Nom : </strong><?= $dishSelected['Name']; ?></p>
                                <p><strong>Prix : </strong><?= $dishSelected['Prize']; ?></p>
                                <p><strong>Description : </strong><?= $dishSelected['Description']; ?></p>
                            </div>
                    </div>
                <?php endforeach ?>
        <div><input class="btn btn-primary btn-block" type="submit" onClick="confirmation()" value="Commander"></div>
        </div>
    </div>
</div>

<?php $contenu = ob_get_clean();?>
<?php require ("Pattern.php");?>

<!-- Script javascript permettant d'ouvrir la boîte de confirmation de suppression de commande -->
<SCRIPT LANGUAGE="JavaScript">
    function confirmation() {
        var msg = "Êtes-vous sur de vouloir passer cette commande ?";
        if (confirm(msg))
            location.replace(View_Panier.php);
    }
</SCRIPT>