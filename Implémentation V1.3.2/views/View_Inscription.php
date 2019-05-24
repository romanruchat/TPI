<?php Ob_start(); ?>
<div class="container">
    <div class="card card-register mx-auto mt-5">
            <!-- formulaire  d'inscription -->
          <div class="card-header">Formulaire d'inscription</div>
          <div class="card-body">
            <form action="?action=AddUser" method="post">
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <div class="form-label-group">
                      <input type="text" id="firstName" name="firstName" class="form-control" placeholder="Prénom" required="required" autofocus="autofocus"/>
                      <label for="firstName">Prénom</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-label-group">
                      <input type="text" id="lastName" name="lastName" class="form-control" placeholder="Nom" required="required"/>
                      <label for="lastName">Nom</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Adresse Email" required="required"/>
                  <label for="inputEmail">Adresse mail</label>
                </div>
              </div>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <div class="form-label-group">
                      <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Mot de passe" required="required"/>
                      <label for="inputPassword">Mot de passe</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-label-group">
                      <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="Répéter le mot de passe" required="required"/>
                      <label for="confirmPassword">Répéter le mot de passe</label>
                    </div>
                  </div>
                </div>
              </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-9">
                            <div class="form-label-group">
                                <input type="text" id="inputCity" name="inputCity" class="form-control" placeholder="Ville" required="required"/>
                                <label for="inputCity">Ville</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-label-group">
                                <input type="number" id="postCode" name="postCode" class="form-control" placeholder="Code Postal" value="1000" required="required"/>
                                <label for="postCode">Code Postal</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <input type="text" id="streetName" name="streetName" class="form-control" placeholder="Rue" required="required"/>
                                <label for="streetName">Nom de la rue</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-label-group">
                                <input type="number" id="streetNumber" name="streetNumber" class="form-control" placeholder="Numéro de rue" value="0" required="required"/>
                                <label for="streetNumber">Numéro de rue</label>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-label-group">
                                <input type="number" id="floorNumber" name="floorNumber" class="form-control" placeholder="Numéro d'étage" value="0" required="required"/>
                                <label for="floorNumber">Numéro d'étage</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div><input class="btn btn-primary btn-block" type="submit"  value="S'inscrire"></div>
                <div class="ErrorMsg"><?=@$_GET["errorMessage"]?></div>
            </form>
        </div>
    </div>
</div>
<?php $contenu = ob_get_clean();?>
<?php require ("Pattern.php");?>