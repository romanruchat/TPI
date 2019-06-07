<?php

/*

Créateur : Roman Ruchat
Date de création : 16.05.2019
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

    $request = $connexion->prepare('SELECT Dishes.idDishes, Dishes.Name, Dishes.Prize, Dishes.Description, Dishes.Status, Images.Name as img FROM Dishes INNER JOIN Images ON Dishes.idDishes = Images.Dishes_idDishes WHERE Dishes.Status = "1" GROUP BY Dishes.idDishes;');
    $request->execute();
    $data=$request->fetchAll();
    return $data;
}

//Fonction permettant la recherche de plats
// $term est le texte rentré par l'utilisateur
function research($term){

    $term = htmlspecialchars($term); //pour sécuriser le formulaire contre les failles html
    $connexion = get_bd();
    $request = $connexion->prepare('SELECT Dishes.idDishes, Dishes.Name, Dishes.Prize, Dishes.Description, Dishes.Status, Images.Name as img FROM Dishes INNER JOIN Images ON Dishes.idDishes = Images.Dishes_idDishes WHERE Dishes.Status=1 AND Dishes.Name LIKE ? OR Dishes.Description LIKE ? GROUP BY idDishes');
    $request->execute(array("%".$term."%", "%".$term."%"));

    $data=$request->fetchAll();
    return $data;
}

//Fonction de suppression de compte
// $id est l'ID de l'utilisateur
function account_removal($id){

    // Connexion à la BD
    $connexion = get_bd();

    //delete from user has particularities
    $request = $connexion->prepare('DELETE FROM User_has_Particularities WHERE User_idUsers = ? ');
    $request->execute(array($id));

    //delete from orders
    $request = $connexion->prepare('DELETE FROM `Order` WHERE User_idUsers = ? ');
    $request->execute(array($id));

    //delete from users
    $request = $connexion->prepare('DELETE FROM User WHERE idUser = ? ');
    $request->execute(array($id));
}

//Fonction de suppression de spécificités
//$idParticularity est l'id de la particularité à supprimer
function particularity_removal($idParticularity){

    // Connexion à la BD
    $connexion = get_bd();

    //delete from user has particularities
    $request = $connexion->prepare('DELETE FROM User_has_Particularities WHERE Particularities_idParticularities = ? ');
    $request->execute(array($idParticularity));


    //delete from particularities has dishes
    $request = $connexion->prepare('DELETE FROM Dishes_has_Particularities WHERE Particularities_idParticularities = ? ');
    $request->execute(array($idParticularity));

    //delete from particularities
    $request = $connexion->prepare('DELETE FROM Particularities WHERE idParticularities = ? ');
    $request->execute(array($idParticularity));

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
function add_user_particularities($idUser, $idParticularities){

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

//Supprime les particularité du plat
//$idDish est l'id du plat où les spécificités vont être supprimées
function delete_dish_particularities($idDish){

    // Connexion à la BD
    $connexion = get_bd();
    $request = $connexion->prepare('DELETE FROM Dishes_has_Particularities WHERE Dishes_idDishes = ?');
    $request->execute(array($idDish));
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

//Ajoute un plat à la BDD
//$dishName est le nom du plat, $dishPrize est le prix du plat et $dishDescription et sa description
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

//Récupère les informations d'un plat en fonction d'un paramètre
//$param est le paramètre d'entrée qui prend soit le nom du plat, soit l'id du plat, soit son apparition dans le site
function get_dish($param){

    // Connexion à la BD
    $connexion = get_bd();

    $request = false;

    if(isset($param["name"])) {
        $request = $connexion->prepare('SELECT * FROM Dishes  WHERE Name = ? ');
        $request->execute(array($param["name"]));
    } else if (isset($param["id"])) {
        $request = $connexion->prepare('SELECT Dishes.idDishes, Dishes.Name, Dishes.Prize, Dishes.Description, Dishes.Status, Images.Name as img FROM Dishes INNER JOIN Images ON Dishes.idDishes = Images.Dishes_idDishes WHERE Dishes.Status = "1" AND Dishes.idDishes = ? GROUP BY Dishes.idDishes');
        $request->execute(array($param['id']));
    } else if (isset($param["last"])){
        $request = $connexion->prepare('SELECT * FROM Dishes  ORDER BY idDishes DESC LIMIT 1 ');
        $request->execute(array());
    }

    $data=$request->fetchAll();
    if(empty($data[0])){
        return false;
    }
    return $data[0];

}

//Ajoute les particularités à un plat
//$idParticularities est l'id de la spécificité à ajouter, $idDish est l'id du plat où la spécificité va être ajoutée
function dish_particularities($idParticularities, $idDish){

    // Connexion à la BD
    $connexion = get_bd();

    $request = $connexion->prepare('INSERT INTO Dishes_has_Particularities (Particularities_idParticularities, Dishes_idDishes) VALUES (?, ?)');
    $request->execute(array($idParticularities, $idDish));
}

//Récupère les spécificités d'un utilisateur
//$idUser est l'id de l'utilisateur
function get_dishes_user($idUser)
{

    // Connexion à la BD
    $connexion = get_bd();

    $request = $connexion->prepare('  SELECT Particularities_idParticularities as idParticularities FROM User_has_Particularities WHERE User_idUsers = ?');
    $request->execute(array($idUser));
    $data = $request->fetchAll();
    return $data;


}

//Récupère toutes les spécificités de tous les plats
function get_dishes_particularities()
{

    // Connexion à la BD
    $connexion = get_bd();

    $request = $connexion->prepare(' SELECT  Particularities_idParticularities as idParticularities, Dishes_idDishes as idDishes FROM Dishes_has_Particularities');
    $request->execute(array());
    $data = $request->fetchAll();
    return $data;

}

//Ajoute une spécificité à la base de données
//$nameParticularity est le nom de spécificité et $typeParticularity et le type de la spécificité
function add_particularity($nameParticularity, $typeParticularity){

    // Connexion à la BD
    $connexion = get_bd();

    $request = $connexion->prepare('INSERT INTO Particularities (Name, Type) VALUES (?, ?)');
    $request->execute(array($nameParticularity, $typeParticularity));

}

//Modifie les données de l'utilisateur
//$lastName est le nom de l'utilisateur, $firstName est le prénom de l'utilisateur, $email est l'email de l'utilisateur, $streetName est le nom de la rue où vit l'utilisateur, $postCode est le code postal où vit l'utilisateur, $city est la ville dans laquelle l'utilisateur vit,  $floorNumber est le numéro d'étage de l'utilisateur, $streetNumber est le numéro de rue de l'utilisateur, $userType est le type de compte qu'a l'utilisateur et enfin $idUser est l'id de l'utilisateur
function update_user($lastName, $firstName, $email, $streetName, $postCode, $city,  $floorNumber, $streetNumber, $userType, $idUser){

    if(isset($userType) && $userType == "administrateur"){
        $userType = '1';
    }else{
        $userType = '0';
    }

    // Connexion à la BD
    $connexion = get_bd();
    $request = $connexion->prepare('UPDATE User Set Name = ?, First_Name = ?, Email = ?, Street = ?, Postcode = ?, City = ?, Floor_Number = ?, Street_Number = ?, User_Type = ? WHERE idUser = ?');
    $request->execute(array($lastName, $firstName, $email, $streetName, $postCode, $city,  $floorNumber, $streetNumber, $userType, $idUser));
}

//Récupère une spécificité
//$idParticularities est l'id de la particularité
function get_particularity($idParticularities){

    // Connexion à la BD
    $connexion = get_bd();

    $request = $connexion->prepare('SELECT * FROM Particularities WHERE idParticularities = ?');
    $request->execute(array($idParticularities));
    $data=$request->fetchAll();
    return $data[0];
}

//Supprime un plat
//$idDish est l'id du plat
function delete_dish($idDish){

    // Connexion à la BD
    $connexion = get_bd();

    $request = $connexion->prepare('UPDATE Dishes SET Status = "0" WHERE idDishes = ?');
    $request->execute(array($idDish));

}

//Modifie une spécificité
//$idParticularity est l'id de la spécificité, $name est le nom de la spécificité et $type est le type de la spécificité
function update_particularity($idParticularity, $name, $type){

    // Connexion à la BD
    $connexion = get_bd();

    $request = $connexion->prepare('UPDATE Particularities SET Name = ?, Type = ? WHERE idParticularities = ?');
    $request->execute(array($name, $type, $idParticularity));
}

//Récupère les particularités d'un plat
//$idDish est l'id du plat
function get_dish_particularities($idDish){

    // Connexion à la BD
    $connexion = get_bd();

    $request = $connexion->prepare('SELECT Particularities_idParticularities AS idParticularities FROM Dishes_has_Particularities WHERE Dishes_idDishes = ?');
    $request->execute(array($idDish));
    $data=$request->fetchAll();
    return $data;
}

//Modifie les informations d'un plat
//$dishName est le nom du plat, $dishPrize est le prix du plat, $dishDescription est la description du plat et $idDish et l'id du plat
function update_dish($dishName, $dishPrize, $dishDescription, $idDish){

    // Connexion à la BD
    $connexion = get_bd();

    $request = $connexion->prepare('UPDATE Dishes SET Name = ?, Prize = ?, Description = ? WHERE idDishes = ?');
    $request->execute(array($dishName, $dishPrize, $dishDescription, $idDish));
}

//Ajoute une image au plat
//$imgName est le nom de l'image et $idDish est l'id du plat
function add_image($imgName, $idDish){

    // Connexion à la BD
    $connexion = get_bd();

    $request = $connexion->prepare('INSERT INTO Images SET Name = ?, Dishes_idDishes = ?');
    $request->execute(array($imgName, $idDish));
}

//ajoute les spécificités à un plat
//$idDish est l'id du plat et $idParticularities est l'id de la spécificité
function add_dish_particularities($idDish, $idParticularities){

    // Connexion à la BD
    $connexion = get_bd();
    $request = $connexion->prepare('INSERT INTO Dishes_has_Particularities (Dishes_idDishes, Particularities_idParticularities) VALUES (?, ?)');
    $request->execute(array($idDish, $idParticularities));
}

//Créé la commande
//$dateOrder est la date et l'heure à laquelle la commande est passé et $idUser est l'id de l'utilisateur
function add_order($dateOrder, $idUser){

    // Connexion à la BD
    $connexion = get_bd();
    $request = $connexion->prepare('INSERT INTO `Order` (Date, User_idUsers) VALUES (?, ?)');
    $request->execute(array($dateOrder, $idUser));
}

//Récupère la dernière commande faite
function get_last_order(){

    // Connexion à la BD
    $connexion = get_bd();
    $request = $connexion->prepare('SELECT * FROM `Order` ORDER BY idOrder DESC LIMIT 1');
    $request->execute(array());
    $data=$request->fetchAll();
    return $data;
}
