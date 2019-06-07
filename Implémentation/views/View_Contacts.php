<?php
/*

Créateur : Roman Ruchat
Date de création : 14.05.2019
But du fichier : C'est ici que sont toutes les données affichées sur la page de contacts

*/
?>

<?php Ob_start(); ?>
<div class="contacts">
    <h1>Contacts</h1>
    <h2>Où nous trouver ?</h2>
    <div>A l'entrée de Prangins à gauche depuis Yverdon, à l'orée de la forêt </div>
    <div>Rêveries</div>
    <div>7 Rue de la Concorde</div>
    <div>1345 L'Orient</div>
    <div>079 900 75 63</div>
    <h2>Horaires d'ouvertures:</h2>
    <div>Lundi fermé</div>
    <div>Mardi à vendredi 11:30 - 14:30 / 18:30 - 00:00</div>
    <div>Samedi et dimanche fermés</div>
</div>

<?php $contenu = ob_get_clean();?>
<?php require ("Pattern.php");?>
