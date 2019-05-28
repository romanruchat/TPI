<?php

/*

Créateur : Roman Ruchat
Date de création : 16.05.2019
Version : 1.0
But du fichier : Ce fichier fait le lien avec la base de données, ils stockent toutes les fonctions nécessitant une liaison à la base de données.
*/

/*Fonctions liées à la base de données, ajout d'utilisateurs, récupérations des données des plats...etc */

//fonction de connexion à la BD
function get_bd()
{
    // connexion à MySQL et BDD reveries
    $connexion = new PDO('mysql:host=localhost;dbname=reveries_db;charset=utf8', 'root', 'Pa$$w0rd');

    // permet d'avoir plus de détails sur les erreurs retournées
    $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    return $connexion;
}

//fonction de récupération des données de l'utilisateur
// $param est une variable qui permet la récupération des données en fonctions de la données déjà en notre possession
function get_user($param)
{
    // Connexion à la BD
    $connexion = get_bd();


    if(isset($param["email"])) {
        $request = $connexion->prepare('SELECT * FROM User  WHERE Email = ? ');
        $request->execute(array($param["email"]));
    } else if (isset($param["id"])) {
        $request = $connexion->prepare('SELECT * FROM User  WHERE idUser = ? ');
        $request->execute(array($param['id']));
    }
 $data=$request->fetchAll();
    if(isset($data[0])){
        return $data[0];
    }else{
        return false;
    }
}

//Fonction d'ajout de l'utilisateur à la Base de données
//Les variables sont les informations de l'utilisateur
function add_user($lastName, $firstName, $password, $email, $streetName, $postCode, $city,  $floorNumber, $streetNumber, $userType){

    if(isset($userType) && $userType == "administrateur"){
        $userType = '1';
    }else{
        $userType = '0';
    }

    //Hache le mot de passe avec l'email
    $hash_password = md5($email.$password);
    // Connexion à la BD
    $connexion = get_bd();
    $request = $connexion->prepare('INSERT INTO User (`Name`, First_Name, Password, Email, Street, Postcode, City, Floor_Number, Street_Number, User_Type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $request->execute(array($lastName, $firstName, $hash_password, $email, $streetName, $postCode, $city, $floorNumber, $streetNumber, $userType));
}

//fonction de récupération des données des plats retournées dans un tableau par la suite
function get_dishes(){

    // Connexion à la BD
    $connexion = get_bd();

    $request = $connexion->prepare('SELECT * FROM Dishes');
    $request->execute();
    $data=$request->fetchAll();
    return $data;
}

//Fonction permettant la recherche de plats
// $term est le texte rentré par l'utilisateur
function research($term){

    $term = htmlspecialchars($term); //pour sécuriser le formulaire contre les failles html
    $connexion = get_bd();
    $request = $connexion->prepare('SELECT Name, Prize, Description FROM Dishes WHERE Name LIKE ? OR Description LIKE ?');
    $request->execute(array("%".$term."%", "%".$term."%"));
    $data=$request->fetchAll();
    return $data;
}

//Fonction de suppression de compte
// $id est l'ID de l'utilisateur
function account_removal($id){

    // Connexion à la BD
    $connexion = get_bd();
    $request = $connexion->prepare('DELETE FROM User WHERE idUser = ? ');
    $request->execute(array($id));
}

//Fonction récupérant l'ensemble des spécificités
function get_particularities_all(){

    // Connexion à la BD
    $connexion = get_bd();
    $request = $connexion->prepare('SELECT idParticularities, Type, Name FROM Particularities  ');
    $request->execute();
    $data=$request->fetchAll();
    return $data;

}

//Fonction ajoutant une particularité à l'utilisateur
// $idUser est l'ID de l'utilisateur, $idParticularities est l'ID de la spécificité
function add_particularities($idUser, $idParticularities){

    // Connexion à la BD
    $connexion = get_bd();
    $request = $connexion->prepare('INSERT INTO User_has_Particularities (User_idUsers, Particularities_idParticularities) VALUES (?, ?)');
    $request->execute(array($idUser, $idParticularities));
}

//Fonction supprimant toutes les spécificités de l'utilisateur
// $idUser est l'ID de l'utilisateur
function delete_user_particularities($idUser){

    // Connexion à la BD
    $connexion = get_bd();
    $request = $connexion->prepare('DELETE FROM User_has_Particularities WHERE User_idUsers = ?');
    $request->execute(array($idUser));

}

//Fonction de récupération des spécificités de l'utilisateur
// $idUser est l'ID de l'utilisateur
function get_user_particularities($idUser){

    // Connexion à la BD
    $connexion = get_bd();
    $request = $connexion->prepare('SELECT Particularities_idParticularities AS idParticularities FROM User_has_Particularities WHERE User_idUsers = ?');
    $request->execute(array($idUser));
    $data=$request->fetchAll();
    return $data;

}

function add_dish($dishName, $dishPrize, $dishDescription){

    // Connexion à la BD
    $connexion = get_bd();
    $request = $connexion->prepare('INSERT INTO Dishes (Name, Prize, Description) VALUES (?, ?, ?)');
    $request->execute(array($dishName, $dishPrize, $dishDescription));
}


//fonction de récupération des données des utilisateurs retournées dans un tableau par la suite
function get_users(){

    // Connexion à la BD
    $connexion = get_bd();

    $request = $connexion->prepare('SELECT * FROM User');
    $request->execute();
    $data=$request->fetchAll();
    return $data;
}

function get_dish($param){

    // Connexion à la BD
    $connexion = get_bd();

    if(isset($param["name"])) {
        $request = $connexion->prepare('SELECT * FROM Dishes  WHERE Name = ? ');
        $request->execute(array($param["name"]));
    } else if (isset($param["id"])) {
        $request = $connexion->prepare('SELECT * FROM Dishes  WHERE idDishes = ? ');
        $request->execute(array($param['id']));
    }

    $data=$request->fetchAll();
    return $data[0];

}

function dish_particularities($idParticularities, $idDish){

    // Connexion à la BD
    $connexion = get_bd();

    $request = $connexion->prepare('INSERT INTO Particularities_has_Dishes (Particularities_idParticularities, Dishes_idDishes) VALUES (?, ?)');
    $request->execute(array($idParticularities, $idDish));
}

/*function add_dish_basket(){

    // Connexion à la BD
    $connexion = get_bd();

}*/