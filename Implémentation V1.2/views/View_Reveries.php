<?php
/**
 * Created by PhpStorm.
 * User: Roman Ruchat
 * Date: 14.05.2019
 */
?>
<?php Ob_start(); ?>
<section class="py-5">
    <div class="container">
        <h3>Le restaurant Rêveries</h3>
        <p class="lead">Ancien second de meilleurs ouvriers de France, Roman Ruchat ravit les papilles de sa clientèle grâce à sa cuisine fusion mélangeant authenticité et originalité. Le restaurant du Rêverie offre à ses clients un cadre exceptionnel de part se vue prenant sur le lac léman. Construit en 1977, il garde aujourd'hui les traces de sa construction originelle tout en apportant un aspect novateur.
        </p>
</section>
<?php $contenu = ob_get_clean(); ?>
<?php require ("Pattern.php"); ?>
