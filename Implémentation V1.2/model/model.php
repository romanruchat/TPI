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

function get_user($email)
{
    // Connexion à la BD
    $connexion = get_bd();

    // Définition de la requête pour sélectionner la personne loguée
    $request = $connexion->prepare('SELECT * FROM User  WHERE Email = ? ');
    $request->execute(array($email));
    $data=$request->fetchAll();
    if(isset($data[0])){
        return $data[0];
    }else{
        return false;
    }
}

//Fonction d'ajout de l'utilisateur à la Base de données
function add_user($lastName, $firstName, $password, $email, $streetName, $postCode, $city,  $floorNumber, $streetNumber){

    $hash_password = md5($email.$password);
    // Connexion à la BD
    $connexion = get_bd();
    $request = $connexion->prepare('INSERT INTO User (`Name`, First_Name, Password, Email, Street, Postcode, City, Floor_Number, Street_Number, User_Type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $request->execute(array($lastName, $firstName, $hash_password, $email, $streetName, $postCode, $city, $floorNumber, $streetNumber, "0"));
}

function get_dishes(){

    // Connexion à la BD
    $connexion = get_bd();

    $request = $connexion->prepare('SELECT Name, Prize, Description FROM Dishes');
    $request->execute();
    $data=$request->fetchAll();
    return $data;
}

function research($term){

    $term = htmlspecialchars($term); //pour sécuriser le formulaire contre les failles html
    $connexion = get_bd();
    $request = $connexion->prepare('SELECT Name, Prize, Description FROM dishes WHERE Name LIKE ? OR Description LIKE ?');
    $request->execute(array("%".$term."%", "%".$term."%"));
    $data=$request->fetchAll();
    return $data;
}




