<?php
/*

Créateur : Roman Ruchat
Date de création : 14.05.2019
But du fichier : Ce fichier est le gabarit du site web avec l'entête et le pied de page qu'auront toutes les pages

*/
?>

<!DOCTYPE html>
<html lang="en">

    <head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
  <title>Rêveries</title>

  <!-- Bootstrap core CSS -->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/full-width-pics.css" rel="stylesheet">

        <!-- Custom fonts for this template-->
    <link href="css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

<!-- Ajout de nouvelle propriétés au site -->
<link href="css/style.css" rel="stylesheet">

</head>

<body>

  <!-- barre de menu -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
      <a class="navbar-brand" href="?action=Accueil">Rêveries</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
              <li class="nav-item <?=($GLOBALS["menuPage"] == "accueil")?"active":""?>">
                  <a class="nav-link" href="?action=Accueil">Accueil</a>
              </li>
              <li class="nav-item <?=($GLOBALS["menuPage"] == "reveries")?"active":""?>">
                  <a class="nav-link" href="?action=Reveries">Rêveries</a>
              </li>
              <li class="nav-item <?=($GLOBALS["menuPage"] == "plats")?"active":""?>">
                  <a class="nav-link" href="?action=GetDishes">Plats</a>
              </li>
              <li class="nav-item <?=($GLOBALS["menuPage"] == "contacts")?"active":""?>">
                  <a class="nav-link" href="?action=Contacts">Contacts</a>
              </li>
            <!-- Affiche les boutons uniquement si l'utilisateur n'est pas connecté -->
              <?php
            if(empty($_SESSION['loggedUser'])) : ?>
                <li class="nav-item <?=($GLOBALS["menuPage"] == "inscription")?"active":""?>">
                <a class="nav-link" href="?action=Inscription">S'inscrire</a>
                </li>
                <li class="nav-item <?=($GLOBALS["menuPage"] == "connexion")?"active":""?>">
                    <a class="nav-link" href="?action=Connexion">Se connecter</a>
                </li>
            <!-- Affiche les boutons uniquement si l'utilisateur est  connecté -->
              <?php endif;
              if(!empty($_SESSION['loggedUser'])) : ?>
                    <li class="nav-item <?=($GLOBALS["menuPage"] == "deconnexion")?"active":""?>">
                        <a class="nav-link" href="?action=Disconnection">Se déconnecter</a>
                    </li>
                  <!-- Affiche les boutons uniquement si l'utilisateur est  administrateur -->
              <?php if (isset($_SESSION['User_Type']) && $_SESSION['User_Type'] == "1") : ?>
              <li class="nav-item">
                  <a class="nav-link" href="?action=ParametersPage">
                      <div class="parametersImage"></div>
                  </a>
              </li>
                  <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="?action=Profile">
                            <div class="profileImage"></div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?action=Basket">
                            <div class="basketImage"></div>
                        </a>
                    </li>
              <?php endif ?>
          </ul>
      </div>
  </div>
  </nav>
    <!--__________CONTENU__________-->
        <div class="span12" id="divMain">
            <?=$contenu; ?>
        </div>
        <!--________FIN CONTENU________-->
        <footer class="py-5 bg-dark">
          <div class="container">
              <p class="m-0 text-center text-white">Roman Ruchat Rêveries TPI 2019</p>
              <p class="m-0 text-center text-white">7 Rue de la Concorde 1345 L'Orient</p>
              <p class="m-0 text-center text-white">0799007562</p>
          </div>
        </footer>
        <!-- Bootstrap core JavaScript -->
        <script src="jquery/jquery.min.js"></script>
        <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>
</html>