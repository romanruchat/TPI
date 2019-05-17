<?php
/* 

Créateur : Roman Ruchat
Date de création : 07.03.2019
But du fichier : Ce fichier redirige l'application vers la bonne fonction en fonction de l'activité de l'utilisateur.

*/

//démarrage de la session
session_start();

//Appel du contrôleur
require("controller/controller.php");

//Création d'une variable action qui récupérera via l'url les actions renvoyées par les différentes pages
$action = @$_GET['action'];

//Switch appelant les différentes fonctions du contrôleur en fonction de l'action reçue
switch($action){
    case 'Accueil':
        accueil();
    break;
    case 'Reveries':
        reveries();
        break;
    case 'Plats':
        plats();
        break;
    case 'Inscription':
        inscription();
        break;
    case 'Connexion':
        connexion();
        break;
    case 'AddUser':
        adduser();
        break;
    case 'Login':
        login();
        break;
    case 'GetDishes':
        getdishes();
        break;
    default : accueil();
    break;
}
    
