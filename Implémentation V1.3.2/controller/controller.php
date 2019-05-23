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

function contacts(){
    require('views/View_Contacts.php');
}

function adduser(){

    if($_POST['inputPassword'] != $_POST['confirmPassword']){
        ?>
        <script>document.location.href="index.php?action=Inscription&errorMessage=Mot de passe non similaire";</script>
        <?php
        exit();
    }
    add_user($_POST['lastName'], $_POST['firstName'], $_POST['inputPassword'],  $_POST['inputEmail'], $_POST['streetName'], $_POST['postCode'], $_POST['inputCity'], $_POST['floorNumber'], $_POST['streetNumber']);
    ?>
    <script>document.location.href="index.php?action=Accueil";</script>
    <?php
}

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

function getdishes(){

    $dishes = get_dishes();
    require('views/View_Plats.php');
}


function search(){

    $dishes = research($_POST['term']);
    require('views/View_Plats.php');
}

function disconnection(){

    unset($_SESSION['loggedUser']);
    accueil();
}

function profile(){

    $data = get_user(["id" => $_SESSION['loggedUser']]);
    /*$intos = get_particularities_into();
    $allergies = get_particularities_allergy();
    $diets = get_particularities_diet();*/

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


function removal(){
    account_removal($_SESSION['loggedUser']);
    accueil();
}

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

function adddishesbasket(){

    add_dishes_basket();
}
?>



