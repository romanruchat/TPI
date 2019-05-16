<?php

/*

Créateur : Roman Ruchat
Date de création : 16.05.2019
Version : 1.0
But du fichier : Ce fichier fait le lien avec la base de données, ils stockent toutes les fonctions nécessitant une liaison à la base de données.
*/

/*Fonctions liées à la base de données, ajout d'utilisateurs, récupérations de stastiques..etc */

// Connexion à la BD
function get_bd()
{
    // connexion à MySQL et BDD reveries
    $connexion = new PDO('mysql:host=localhost;dbname=reveries_db;charset=utf8', 'root', 'Pa$$w0rd');

    // permet d'avoir plus de détails sur les erreurs retournées
    $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    return $connexion;
}

function get_user()
{
    // Connexion à la BD
    $connexion = get_bd();

    // Définition de la requête pour sélectionner la personne loguée
    $request = $connexion->prepare('SELECT * FROM user  WHERE Email = ? ');
    $request->execute(array($email));


    $user=$request->fetchAll();
    if(isset($donnees[0])){
        return $donnees[0];
    }else{
        return false;
    }
}

//Fonction d'ajout de l'utilisateur à la Base de données
function add_user($lastName, $firstName, $password, $email, $streetName, $postCode, $city,  $floorNumber, $streetNumber){

    $hash_password = md5($email.$password);
    // Connexion à la BD
    $connexion = get_bd();
    $request = $connexion->prepare('INSERT INTO user (`Name`, First_Name, Password, Email, Street, Postcode, City, Floor_Number, Street_Number) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $request->execute(array($lastName, $firstName, $hash_password, $email, $streetName, $postCode, $city, $floorNumber, $streetNumber));
}

