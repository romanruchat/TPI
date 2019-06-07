<?php
/* 

Créateur : Roman Ruchat
Date de création : 07.05.2019
But du fichier : Ce fichier redirige l'application vers la bonne fonction en fonction de l'activité de l'utilisateur.

*/

//démarrage de la session
session_start();

//Appel du contrôleur
require("controller/controller.php");

//Création d'une variable action qui récupérera via l'url les actions renvoyées par les différentes pages
$action = @$_GET['action'];

//Déclaration de la variable permettant le changement de couleur des boutons du menu
$menuPage = "";

//Switch appelant les différentes fonctions du contrôleur en fonction de l'action reçue
// $action est l'action reçu via l'url qui nous permet de
switch($action){
    case 'Accueil':
        $menuPage = "accueil";
        accueil();
    break;
    case 'Reveries':
        $menuPage = "reveries";
        reveries();
        break;
    case 'Plats':
        $menuPage = "plats";
        plats();
        break;
    case 'Contacts':
        $menuPage = "contacts";
        contacts();
    break;
    case 'Inscription':
        $menuPage = "inscription";
        inscription();
        break;
    case 'Connexion':
        $menuPage = "connexion";
        connexion();
        break;
    case 'AddUser':
        adduser();
        break;
    case 'Login':
        $menuPage = "connexion";
        login();
        break;
    case 'GetDishes':
        $menuPage = "plats";
        getdishes();
        break;
    case 'Search':
        search();
        break;
    case 'Disconnection':
        $menuPage = "deconnexion";
        disconnection();
        break;
    case 'Profile':
        profile();
        break;
    case 'Removal':
        removal();
        break;
    case 'AddDishPage':
        adddishpage();
        break;
    case 'AddDish':
        adddish();
        break;
    case 'AddUserParticularities':
        adduserparticularities();
        break;
    case 'AddDishBasket':
        adddishbasket();
        break;
    case 'ParametersPage':
        parameterspage();
        break;
    case 'Basket':
        basket();
        break;

    case 'ConfirmOrder':
        confirmorder();
        break;
    case 'AddParticularityPage':
        addparticularitypage();
        break;
    case 'AddParticularity':
        addparticularity();
        break;
    case 'DeselectDish':
        deselectdish();
        break;
    case'UserUpdatePage':
        updateuserpage();
        break;
    case 'UpdateUser':
        updateuser();
        break;
    case 'ParticularityUpdatePage':
        particularityupdatepage();
        break;
    case 'DeleteDish':
        deletedish();
        break;
    case'DeleteUser':
        deleteuser();
        break;
    case'UpdateParticularity':
        updateparticularity();
        break;
    case'UpdateDishPage':
        updatedishpage();
        break;
    case'UpdateDish':
        updatedish();
        break;
    case'DeleteParticularity':
        deleteparticularity();
        break;
    case'InformationsDishPage':
        informationsdishPage();
        break;
    default : accueil();
    $menuPage = "accueil";
    break;
}
    
