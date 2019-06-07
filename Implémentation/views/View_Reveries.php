<?php
/*

Créateur : Roman Ruchat
Date de création : 14.05.2019
But du fichier : C'est ici que sont toutes les données affichées sur la page de présentation

*/
?>
<?php Ob_start(); ?>
<section class="py-5">
    <div class="container">
        <h3>Le restaurant Rêveries</h3>
        <p class="lead">Ancien second de meilleurs ouvriers de France, Roman Ruchat ravit les papilles de sa clientèle grâce à sa cuisine fusion mélangeant authenticité et originalité. Le restaurant Rêverie offre à ses clients un cadre exceptionnel de part sa vue prenane sur le lac léman. Construit en 1977, il garde aujourd'hui les traces de sa construction originelle tout en apportant un aspect novateur.
        </p>

        <!-- Image Section - set the background image for the header in the line below -->
        <section class="py-5 bg-image-full" style="background-image: url('/assets/img/lac.jpg');">
            <!-- Put anything you want here! There is just a spacer below for demo purposes! -->
            <div style="height: 200px;"></div>
        </section>

        <br><p class="lead" >Caché dans le petit village de Prangins et au milieu d'une calme forêt, Rêveries offre le cadre parfait pour toutes les personnes ayant besoin de sérénité, de calme et de bonne cuisine. Ce restaurant surprend pour son envie de faire plaisir, en effet, il fera tout pour permettre au client de se sentir comme chez lui, autant gustativement qu'humainement.</p>
</section>
<?php $contenu = ob_get_clean(); ?>
<?php require ("Pattern.php"); ?>
