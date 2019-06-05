<?php
/**
 * Created by PhpStorm.
 * User: Roman Ruchat
 * Date: 14.05.2019
 */
?>

<?php Ob_start(); ?>
  <!-- Content section -->
<div class="ErrorMsg"><?=@$_GET["errorMessage"]?></div>
  <section class="py-5">
    <div class="container">
        <h3>Actualités</h3>
      <p class="lead">Nos fameuses soirées sangliers sont de retour : la prochaine est agendée au mercredi 20 février 2019 <br>
      Les spécialités incontournables n'ont pas changé depuis 30 ans. Notre saumon sauvage en Gravad lax à l'aneth et notre tartare de saumon unique. Nos suggestions au gré des saisons. Le Chef Roman Ruchat et sa brigade vous proposent, entre autres, la côte de bœuf de la boucherie « Nardi » ou le filet mignon de Pata Negra Bellota à la truffe noire de chez « Luma », les suggestions de pâtes maison mais encore le coquelet entier de la ferme cuit minute entier au four. Ou encore les Noix de Sant-Jacques snackées, beurre blan et pamplemousse rose risotto à la truffe. Sans oublier les rognons flambés au cognac et sauce moutarde de Meaux. </p>
    </div>
  </section>

  <!-- Image Section - set the background image for the header in the line below -->
  <section class="py-5 bg-image-full" style="background-image: url('/assets/img/accueil.jpg');">
    <!-- Put anything you want here! There is just a spacer below for demo purposes! -->
    <div style="height: 200px;"></div>
  </section>

<div class="container">

    <br><p class="lead">Du 21 juin au 18 septembre ! <br> Le retour des soirées plages sont aussi de retour, l'équipe de Rêverie offre un accès au bord du lac et propose de servir de quoi se restaurer ainsi que de que cocktails rafraichssiant</p>

</div>

<?php $contenu = ob_get_clean();?>
<?php require ("Pattern.php");?>
