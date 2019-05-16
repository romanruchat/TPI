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

function adduser(){

    if($_POST['inputPassword'] != $_POST['confirmPassword']){
        ?>
        <script>document.location.href="index.php?action=Inscription&errorMessage=Mot de passe non similaire";</script>
        <?php
        exit();
    }
    add_user($_POST['lastName'], $_POST['firstName'], $_POST['inputPassword'],  $_POST['inputEmail'], $_POST['streetName'], $_POST['postCode'], $_POST['inputCity'], $_POST['floorNumber'], $_POST['streetNumber'],  );
    ?>
    <script>document.location.href="index.php?action=Accueil";</script>
    <?php
}

function login(){

    $user = get_user($_POST['inputEmail']);
    if(!empty($_POST['inputPassword']) && !empty($_POST['inputEmail']) &&
        $user['Password'] == md5($_POST['inputEmail'].$_POST['inputPassword'])){
        $_SESSION['loggedUser'] = $user['idUsers'];
        ?><script>document.location.href="index.php?action=Accueil";</script>
        <?php
        exit();
    }else{
        ?>
        <script>document.location.href="index.php?action=LogIn&errorMessage=Informations erronées";</script>
        <?php
        exit();
    }
}
