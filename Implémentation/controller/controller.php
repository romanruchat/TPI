<?php
/* 

Créateur : Roman Ruchat
Date de création : 07.03.2019
Version : 1.0
But du fichier : Ce fichier sert à lier l'utilisateur avec le modèle. Il contient les fonctions qui appelle les fonctions liées à la base de données.

*/

/* Déclaration des fonctions qui renvoie sur les différentes page d'affichage */

//Affiche la page d'accueil
function accueil(){
    require('views/View_Accueil.php');
}
function reveries(){
    require('views/View_Reveries.php');
}

function plats(){
    require('views/View_Plats.php');
}

