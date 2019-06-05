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
        <script>document.location.href="index.php?action=Inscription&Message=Mot de passe non similaire";</script>
        <?php
        exit();
    }
    add_user($_POST['lastName'], $_POST['firstName'], $_POST['inputPassword'],  $_POST['inputEmail'], $_POST['streetName'], $_POST['postCode'], $_POST['inputCity'], $_POST['floorNumber'], $_POST['streetNumber'], $_POST['userType']);
    ?>
    <script>document.location.href="index.php?action=Accueil&Message=Inscription réussie";</script>
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

  /* $userDish = array();
    $dishes = get_dishes_user($_SESSION['loggedUser']);
    if(isset($_SESSION['loggedUser'])){

        $all = get_dishes();
        foreach($dishes as $dish){
            foreach ($all as $alldish){
                if($dish = $alldish){

                    array_push($userDish, $dish);
                }
            }
        }
        return $userDish;
    }else {
        $dishes = get_dishes();
    }
*/
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
    $dish = get_dish(["name" => $_POST['dishName']]);
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

function adddishbasket()
{

    if (isset($_SESSION['loggedUser']))
    {
        $dish = get_dish(["id" => $_POST['idDish']]);
        if (!isset($_SESSION['dishesSelected'])) {
            $_SESSION['dishesSelected'] = array();
        }
    array_push($_SESSION['dishesSelected'], $dish);
    }else{
        $_SESSION['dishesSelected'] = array();
        ?>
        <script>document.location.href="index.php?action=Connexion&Message=Vous devez être connecté pour pouvoir ajouter au panier";</script>
        <?php
    }
    basket();
}

function msgbasket(){

    if(!empty($_SESSION['dishesSelected'])){
        ?>
        <script>document.location.href="index.php?action=Basket&Message=Votre panier est vide ! Remplissez le de plats !";</script>
        <?php
    } else {
        basket();
    }
}

function basket(){

    require('views/View_Panier.php');
}

function confirmorder(){

    $user = get_user(["id" => $_SESSION['loggedUser']]);
if (strpos($user['Email'], "@cpnv.ch") !== false ) {
    ini_set("SMTP", "mail.cpnv.ch");
    $mail = $user['Email']; // Déclaration de l'adresse de destination.
    if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
    {
        $passage_ligne = "\r\n";
    } else {
        $passage_ligne = "\n";
    }
//=====Déclaration des messages au format texte et au format HTML.
    $message_txt = "Bonjour ! 
            Ceci est un message automatique de confirmation de la commande de " . $user['First_Name'] . " " . $user['Name'] . "
            Voici votre commande :" ;
                if(isset($_SESSION['dishesSelected']))
                foreach($_SESSION['dishesSelected'] as $dishSelected) :
              " Nom du plat " .$dishSelected['Name']. " " .$dishSelected['Prize']." " .$dishSelected['Description']."
            "; endforeach;
            "Nous nous rejouissons de vous retrouver dans peu de temps !";

    // $message_html = "<html><head></head><body><b>Salut à tous</b>, voici un e-mail envoyé par un <i>script PHP</i>.</body></html>";
//==========

//=====Création de la boundary
    $boundary = "-----=" . md5(rand());
//==========

//=====Définition du sujet.
    $sujet = "Confirmation de commande";
//=========

//=====Création du header de l'e-mail.
    $header = "From: \"Reveries\"<roman.ruchat@cpnv.ch>" . $passage_ligne;
    $header .= "Reply-to: \"Reveries\"<roman.ruchat@cpnv.ch>" . $passage_ligne;
    $header .= "MIME-Version: 1.0" . $passage_ligne;
    $header .= "Content-Type: multipart/alternative;" . $passage_ligne . " boundary=\"$boundary\"" . $passage_ligne;
//==========

//=====Création du message.
    $message = $passage_ligne . "--" . $boundary . $passage_ligne;
//=====Ajout du message au format texte.
    $message .= "Content-Type: text/plain; charset=\"ISO-8859-1\"" . $passage_ligne;
    $message .= "Content-Transfer-Encoding: 8bit" . $passage_ligne;
    $message .= $passage_ligne . $message_txt . $passage_ligne;
//==========
    $message .= $passage_ligne . "--" . $boundary . $passage_ligne;
    /*//=====Ajout du message au format HTML
        $message .= "Content-Type: text/html; charset=\"ISO-8859-1\"" . $passage_ligne;
        $message .= "Content-Transfer-Encoding: 8bit" . $passage_ligne;
        $message .= $passage_ligne . $message_html . $passage_ligne;
    //==========*/
    $message .= $passage_ligne . "--" . $boundary . "--" . $passage_ligne;
    $message .= $passage_ligne . "--" . $boundary . "--" . $passage_ligne;
//==========

//=====Envoi de l'e-mail.
    mail($mail, $sujet, $message, $header);
//==========
}else{
    echo "Le site ne peut pas encore envoyer d'email à ce type d'adresse email, merci de votre compréhension";
}
    //Vide le panier
    $_SESSION['dishesSelected'] = array();
    require('views/View_Panier.php');
}

function addparticularitypage(){

    require('views/View_AddParticularityPage.php');
}

function addparticularity(){

    add_particularity($_POST['particularityName'], $_POST['particularities']);
    parameterspage();
}

function updateuserpage(){

    $data = get_user(["id" => $_POST['idUser']]);
    require('views/View_UpdateUserPage.php');

}

function updateuser(){

    update_user($_POST['lastName'], $_POST['firstName'],  $_POST['inputEmail'], $_POST['streetName'], $_POST['postCode'], $_POST['inputCity'], $_POST['floorNumber'], $_POST['streetNumber'], $_POST['userType'], $_POST['idUser']);
    parameterspage();
}

function particularityupdatepage(){

    $data = get_particularity($_POST['idParticularities']);
   require('views/View_UpdateParticularityPage.php');
}

function deselectdish(){

   array_splice($_SESSION['dishesSelected'], 0, 1);
    basket();
}

function deletedish(){

    delete_dish($_POST['idDish']);
    $dishes = get_dishes();
    ?><script>document.location.href="index.php?action=Plats&Message=Suppression réussie";</script><?php
}

function deleteuser(){

    account_removal($_POST['idUser']);
    parameterspage();
}

function updateparticularity(){

    update_particularity($_POST['idParticularities'], $_POST['particularityName'], $_POST['particularities']);
    parameterspage();
}

function updatedishpage(){

    $intos = array();
    $allergies = array();
    $diets = array();

    $all = get_particularities_all();
    $userParticularities = get_user_particularities($_POST['idDish']);

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

    $data = get_dish(["id" => $_POST['idDish']]);
    require('views/View_UpdateDishPage.php');

}

function updatedish(){

    update_dish($_POST['dishName'], $_POST['dishPrize'], $_POST['dishDescription'], $_POST['idDish']);
    plats();
}
?>



