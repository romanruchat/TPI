<?php
/* 

Créateur : Roman Ruchat
Date de création : 07.03.2019
Version : 1.0
But du fichier : Ce fichier sert à lier l'utilisateur avec le modèle. Il contient les fonctions qui appelle les fonctions liées à la base de données.

*/

/* Déclaration des fonctions qui renvoie sur les différentes page d'affichage */


//Appel du modèle
require_once("model/model.php");


//Affiche la page d'accueil
function accueil(){
    require('views/View_Accueil.php');
}

//Affiche la page de présentation
function reveries(){
    require('views/View_Reveries.php');
}

//Affiche la page des plats
function plats(){
    require('views/View_Plats.php');
}

//Affiche la page d'inscription
function inscription(){
    require('views/View_Inscription.php');
}

//Affiche la page de connexion
function connexion(){
    require('views/View_Connexion.php');
}

//Affiche la page de contacts
function contacts(){
    require('views/View_Contacts.php');
}

//Ajoute l'utilisateur à la base de données
function adduser(){

    if($_POST['inputPassword'] != $_POST['confirmPassword']){
        ?>
        <script>document.location.href="index.php?action=Inscription&errorMessage=Mot de passe non similaire";</script>
        <?php
        exit();
    }
    add_user($_POST['lastName'], $_POST['firstName'], $_POST['inputPassword'],  $_POST['inputEmail'], $_POST['streetName'], $_POST['postCode'], $_POST['inputCity'], $_POST['floorNumber'], $_POST['streetNumber'], $_POST['userType']);
    ?>
    <script>document.location.href="index.php?action=Accueil&errorMessage=Inscription réussie";</script>
    <?php
}

//Permet à l'utilisateur de se connecter
function login(){


    $user = get_user(["email" => $_POST['inputEmail']]);
    if(!empty($_POST['inputPassword']) && !empty($_POST['inputEmail']) &&
        $user['Password'] == md5($_POST['inputEmail'].$_POST['inputPassword'])){
        $_SESSION['loggedUser'] = $user['idUser'];
        $_SESSION['User_Type'] = $user['User_Type'];
            ?><script>document.location.href="index.php?action=Accueil";</script>
        <?php
        exit();
    }else{
        ?>
        <script>document.location.href="index.php?action=Connexion&errorMessage=Informations erronées";</script>
        <?php
        exit();
    }
}

//Récupére les plats puis affiche la page des plats
function getdishes(){

    $dishes = get_dishes();
    require('views/View_Plats.php');
}

//Affiche la page de plats avec les plats recherchés
function search(){

    $dishes = research($_POST['term']);
    require('views/View_Plats.php');
}

//Permet à l'utilisateur de se déconnecter
function disconnection(){

    unset($_SESSION['loggedUser']);
    accueil();
}

//Affiche le profil de l'utilisateur avec ses spécificités
function profile(){

    $data = get_user(["id" => $_SESSION['loggedUser']]);

    $intos = array();
    $allergies = array();
    $diets = array();

    $all = get_particularities_all();
    $userParticularities = get_user_particularities($_SESSION['loggedUser']);

    foreach($all as $particularity){
        $particularity['checked'] = false;
        foreach($userParticularities as $userParticularity){
            if($userParticularity["idParticularities"] == $particularity["idParticularities"]){
                $particularity['checked'] = true;
            }
        }
        switch ($particularity["Type"]){
            case 'intolerance':
                array_push($intos, $particularity);
                break;
            case 'allergy':
                array_push($allergies, $particularity);
                break;
            case 'diet':
                array_push($diets, $particularity);
                break;

        }
    }

    require('views/View_Profil.php');


}

//Supprime le compte de l'utilisateur
function removal(){
    account_removal($_SESSION['loggedUser']);
    accueil();
}

//Ajoute les spécificités de l'utilisateur à la base de données
function addparticularities(){

    $all = get_particularities_all();
    delete_user_particularities($_SESSION['loggedUser']);
    foreach($all as $particularity){
        if(!empty($_POST['particularity_'.$particularity['idParticularities']])){
            add_particularities($_SESSION['loggedUser'], $particularity['idParticularities']);
        }
    }
    profile();

}

function adddishpage(){

    $intos = array();
    $allergies = array();
    $diets = array();

    $all = get_particularities_all();

    foreach($all as $particularity){
        switch ($particularity["Type"]){
            case 'intolerance':
                array_push($intos, $particularity);
                break;
            case 'allergy':
                array_push($allergies, $particularity);
                break;
            case 'diet':
                array_push($diets, $particularity);
                break;

        }
    }

    require('views/View_AddDish.php');
}

function adddish(){

    add_dish($_POST['dishName'], $_POST['dishPrize'], $_POST['dishDescription']);
    $dish = get_dish(["name" => $_POST['dishName']]);
    var_dump($dish);
    $all = get_particularities_all();
    foreach($all as $particularity){
        if(!empty($_POST['particularity_'.$particularity['idParticularities']])){
            dish_particularities($particularity['idParticularities'], $dish['idDishes']);
        }
    }

    getdishes();
}

function parameterspage(){

    $users = get_users();
    $particularities = get_particularities_all();
    require('views/View_ParametersPage.php');
}

$dishesSelected = array();

function adddishbasket(){

    global $dishesSelected;
    $dish = get_dish(["id" => $_POST['idDish']]);

    array_push($dishesSelected, $dish);
    require('views/View_Panier.php');
}

function basket(){


    require('views/View_Panier.php');
}
?>



