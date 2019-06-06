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
    //Vérifie si le formulaire est rempli des bonnes informations
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

    if(isset($_SESSION['loggedUser'])) {
        $ParticularitiesByDish = array();
        $finalDishesIds = array();

        $userParticularities = get_dishes_user($_SESSION['loggedUser']);

        $dishesParticularities = get_dishes_particularities();

        //Groupage des particularités des dishes
        foreach ($dishesParticularities as $dishesParticularity) {
            if (!isset($ParticularitiesByDish[$dishesParticularity['idDishes']])) {
                $ParticularitiesByDish[$dishesParticularity['idDishes']] = array();
            }
            array_push($ParticularitiesByDish[$dishesParticularity['idDishes']], $dishesParticularity['idParticularities']);
        }
        foreach ($ParticularitiesByDish as $dishId => $dishParticularities) {
            foreach ($userParticularities as $userParticularity) {
                if (!in_array($userParticularity['idParticularities'], $dishParticularities)) {
                    continue 2;
                }
            }
            array_push($finalDishesIds, $dishId);
        }

        $dishes = array();
        foreach ($finalDishesIds as $finaldishid) {
            $dish = get_dish(["id" => $finaldishid]);
            if($dish != false) {
                array_push($dishes, $dish);
            }
        }
        require('views/View_Plats.php');
    }else{

        $dishes = get_dishes();
        require('views/View_Plats.php');
    }
}

//Affiche la page de plats avec les plats recherchés
function search(){

    $dishes = research($_POST['term']);
    require('views/View_Plats.php');
}

//Permet à l'utilisateur de se déconnecter
function disconnection(){
    $_SESSION = array();
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

    //Vérifie quelles spécificité est enregistré et les tris selon leur type
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

//Supprime le compte de l'utilisateur de la base de données
function removal(){
    account_removal($_SESSION['loggedUser']);
    disconnection();
}

//Supprime la particularité de la base de données
function deleteparticularity(){

    particularity_removal($_GET['idParticularities']);
      parameterspage();
}
//Ajoute les spécificités de l'utilisateur à la base de données
function adduserparticularities(){

    $all = get_particularities_all();

    //Supprime les particularités de l'utilisateur
    delete_user_particularities($_SESSION['loggedUser']);

    //Traverse toutes les particularités et ajoute celle sélectionnées
    foreach($all as $particularity){
        if(!empty($_POST['particularity_'.$particularity['idParticularities']])){
            add_user_particularities($_SESSION['loggedUser'], $particularity['idParticularities']);
        }
    }
    profile();

}

//Affiche la page d'ajout de plat
function adddishpage(){

    $intos = array();
    $allergies = array();
    $diets = array();

    $all = get_particularities_all();

    //Traverse les particularités et les ajoutent à des tableaux en fonction de leur type
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

//Ajoute le plat à la base de données
function adddish(){

    add_dish($_POST['dishName'], $_POST['dishPrize'], $_POST['dishDescription']);
    $dish = get_dish(["last" => true]);
    $all = get_particularities_all();

    //Ajoute les particularités au plat
    foreach($all as $particularity){
        if(!empty($_POST['particularity_'.$particularity['idParticularities']])){
            dish_particularities($particularity['idParticularities'], $dish['idDishes']);
        }
    }

    //Gestion d'images
    if(!empty($_FILES["dishImages"]["tmp_name"][0])){
        foreach ($_FILES["dishImages"]["tmp_name"] as $tmp_name) {
            $imgName = generateRandomString();
            move_uploaded_file($tmp_name, "C:\TPI\assets\dishImg\\".$imgName);
            add_image($imgName, $dish['idDishes']);
            //
        }
    } else {
        add_image("default.jpg", $dish['idDishes']);
    }
    getdishes();
}

//Affiche la page de paramètres
function parameterspage(){

    $users = get_users();
    $particularities = get_particularities_all();
    require('views/View_ParametersPage.php');
}

//Ajoute le plat au panier
function adddishbasket()
{
    //Récupère les infos du plats et les ajoutent à un tableau
    if (isset($_SESSION['loggedUser']))
    {
        $dish = get_dish(["id" => $_POST['idDish']]);
        if (!isset($_SESSION['dishesSelected'])) {
            $_SESSION['dishesSelected'] = array();
        }
        if(!isset($_SESSION['dishesSelected'][$dish['idDishes']])) {
            $_SESSION['dishesSelected'][$dish['idDishes']] = $dish;
            $_SESSION['dishesSelected'][$dish['idDishes']]['count'] = 0;
        }
        $_SESSION['dishesSelected'][$dish['idDishes']]['count']++;

    //array_push($_SESSION['dishesSelected'], $dish);
    }else{
        $_SESSION['dishesSelected'] = array();
        ?>
        <script>document.location.href="index.php?action=Connexion&Message=Vous devez être connecté pour pouvoir ajouter au panier";</script>
        <?php
    }
    getdishes();
}


function basket(){

    $message = "";
    $emptyBasket = false;

    if(empty($_SESSION['dishesSelected'])){
        $emptyBasket = true;
    }

    if(isset($_GET["Message"]))
    {
        $message=$_GET["Message"];
    }
    require('views/View_Panier.php');
}

function confirmorder(){

    $dateOrder = date('Y-n-j H:i:s ');
    echo $dateOrder;
    add_order($dateOrder, $_SESSION['loggedUser']);
    $data = get_last_order();
var_dump($_POST);
    //add_dishes_order($data['idOder'], $_POST['idDishSelected']);
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
    if(isset( $_SESSION['dishesSelected'][$_POST["idDishSelected"]])) {
        $_SESSION['dishesSelected'][$_POST["idDishSelected"]]['count']--;
        if ($_SESSION['dishesSelected'][$_POST["idDishSelected"]]['count'] == 0) {
            unset($_SESSION['dishesSelected'][$_POST["idDishSelected"]]);
        }
    }
    basket();
}

function deletedish(){

    delete_dish($_POST['idDish']);
    getdishes();
}

function deleteuser(){
    account_removal($_GET['idUser']);
    parameterspage();
}

function updateparticularity(){

    update_particularity($_POST['idParticularities'], $_POST['particularityName'], $_POST['particularities']);
    parameterspage();
}

function updatedishpage(){

    if(empty($_GET['idDish'])){
        echo "erreur";
        getdishes();
        return;
    }

    $idDish = $_GET['idDish'];

    $intos = array();
    $allergies = array();
    $diets = array();

    $all = get_particularities_all();
    $dishParticularities = get_dish_particularities($idDish);

    foreach($all as $particularity){
        $particularity['checked'] = false;
        foreach($dishParticularities as $dishParticularity){
            if($dishParticularity["idParticularities"] == $particularity["idParticularities"]){
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

    $data = get_dish(["id" => $idDish]);
    require('views/View_UpdateDishPage.php');

}

function updatedish(){

    $all = get_particularities_all();
    delete_dish_particularities($_POST['idDish']);
    foreach($all as $particularity){
        if(!empty($_POST['particularity_'.$particularity['idParticularities']])){
            add_dish_particularities($_POST['idDish'], $particularity['idParticularities']);
        }
    }
    update_dish($_POST['dishName'], $_POST['dishPrize'], $_POST['dishDescription'], $_POST['idDish']);
    ?><script>document.location.href="index.php?action=UpdateDishPage&idDish=<?=$_POST['idDish']?>";</script><?php
    exit();
}

/**/
function getDishImg($imgName){
    return "/assets/dishImg/".$imgName;
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function informationsdishPage(){

    $idDish = $_GET['idDish'];

    $intos = array();
    $allergies = array();
    $diets = array();

    $all = get_particularities_all();
    $dishParticularities = get_dish_particularities($idDish);

    foreach($all as $particularity){
        $particularity['checked'] = false;
        foreach($dishParticularities as $dishParticularity){
            if($dishParticularity["idParticularities"] == $particularity["idParticularities"]){
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

   $data = get_dish(["id" => $idDish]);
    require('views/View_InformationsDishPage.php');
}

?>



