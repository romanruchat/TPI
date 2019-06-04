<?php Ob_start(); ?>
<div class="container">
    <div class="card card-register mx-auto mt-5">
        <!-- formulaire  d'inscription -->
        <div class="card-header">Modification d'un utilisateur</div>
        <div class="card-body">
            <form action="?action=UpdateUser" method="post">
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <input hidden id="idUser" name="idUser" value="<?= $data['idUser']; ?>"/>
                                <input type="text" id="firstName" name="firstName" class="form-control" value="<?= $data['First_Name']; ?>" placeholder="Prénom" required="required" autofocus="autofocus"/>
                                <label for="firstName">Prénom</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <input type="text" id="lastName" name="lastName" class="form-control" value="<?= $data['Name']; ?>" placeholder="Nom" required="required"/>
                                <label for="lastName">Nom</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="email" id="inputEmail" name="inputEmail" class="form-control" value="<?= $data['Email']; ?>" placeholder="Adresse Email" required="required"/>
                        <label for="inputEmail">Adresse mail</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-9">
                            <div class="form-label-group">
                                <input type="text" id="inputCity" name="inputCity" class="form-control" value="<?= $data['City']; ?>" placeholder="Ville" required="required"/>
                                <label for="inputCity">Ville</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-label-group">
                                <input type="number" id="postCode" name="postCode" class="form-control" value="<?= $data['Postcode']; ?>" placeholder="Code Postal" required="required"/>
                                <label for="postCode">Code Postal</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <input type="text" id="streetName" name="streetName" class="form-control" value="<?= $data['Street']; ?>" placeholder="Rue" required="required"/>
                                <label for="streetName">Nom de la rue</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-label-group">
                                <input type="number" id="streetNumber" name="streetNumber" class="form-control" value="<?= $data['Street_Number']; ?>" placeholder="Numéro de rue" required="required"/>
                                <label for="streetNumber">Numéro de rue</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-label-group">
                                <input type="number" id="floorNumber" name="floorNumber" class="form-control" value="<?= $data['Floor_Number']; ?>" placeholder="Numéro d'étage" required="required"/>
                                <label for="floorNumber">Numéro d'étage</label>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if($data['User_Type'] == "1") : ?>
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="text" id="userType" name="userType" class="form-control" value="administrateur" placeholder="Type d'utilisateur" required="required"/>
                            <label for="userType">Type d'utilisateur</label>
                        </div>
                    </div>
                <?php endif ?>
                <?php if($data['User_Type'] == "0") : ?>
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="text" id="userType" name="userType" class="form-control" value="Client standard" placeholder="Type d'utilisateur" required="required"/>
                            <label for="userType">Type d'utilisateur</label>
                        </div>
                    </div>
                <?php endif ?>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div><input class="btn btn-primary btn-block" type="submit"  value="modifier les données de l'utilisateur"></div>
                            <div class="ErrorMsg"><?=@$_GET["errorMessage"]?></div>
                        </div>
                        <div class="col-md-6">
                            <form action="?action=DeleteUser" method="post">
                                <input hidden id="idUser" name="idUser" value="<?= $data['idUser']; ?>"/>
                                 <div><input class="btn btn-primary btn-block" onClick="confirmation()" type="submit"  value="Supprimer le compte"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $contenu = ob_get_clean(); ?>
<?php require ("Pattern.php"); ?>

<!-- Script javascript permettant d'ouvrir la boîte de confirmation de suppression de compte -->
<SCRIPT>
    function confirmation() {
        var msg = "Êtes-vous sur de vouloir supprimer le compte ?";
        if (confirm(msg))
            location.replace(View_Profil.php);
    }
</SCRIPT>
