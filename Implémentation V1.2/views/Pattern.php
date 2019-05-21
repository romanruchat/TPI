<?php
/**
 * Created by PhpStorm.
 * User: Roman Ruchat
 * Date: 14.05.2019
 */
?>

<!DOCTYPE html>
<html lang="en">

    <head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Rêveries</title>

  <!-- Bootstrap core CSS -->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/full-width-pics.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="?action=Accueil">Rêveries</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="?action=Accueil">Accueil
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="?action=Reveries">Rêveries</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?action=GetDishes">Plats</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?action=Contacts">Contacts</a>
          </li>
            <?php
            if(empty($_SESSION['loggedUser'])){
                echo '
                    <li class="nav-item">
                        <a class="nav-link" href="?action=Inscription">S\'inscrire</a>
                    </li>';
            }?>
            <?php
            if(empty($_SESSION['loggedUser'])){
                echo '
                    <li class="nav-item">
                        <a class="nav-link" href="?action=Connexion">Se connecter</a>
                    </li>';
            }?>
            <?php
            if(!empty($_SESSION['loggedUser'])){
                echo '
                    <li class="nav-item">
                        <a class="nav-link" href="?action=GetDishes">TEST</a>
                    </li>';
            }?>


        </ul>
      </div>
    </div>
  </nav>

  <!-- Header - set the background image for the header in the line below -->
  <header class="py-5 bg-image-full"">
  <h1 style="text-align: center">Rêveries</h1>
    </header>
        <!--__________CONTENU__________-->
        <div class="span12" id="divMain">
            <?=$contenu; ?>
        </div>
        <!--________FIN CONTENU________-->
<footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Roman Ruchat Rêveries TPI 2019</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="jquery/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>    
    </body>
    

</html>