<?php
// Début de la SESSION
session_start();
// Inclusion des classes "pronote_management.php", "retard_management.php" et "retard.php"
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/retard/retard.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/retard/retard_management.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/pronote_management.php');

// Vérification des accès a la page
if(empty($_COOKIE['user']) || $_COOKIE['poste'] == 'ETU') {
    $erreur = new pronote_management();
    $erreur->setMessage('Vous n\'avez pas accès a cette page','index.php');
}
// Vérification pour savoir si le formulaire a bien été remplit
elseif(empty($_POST['date_ret']) || empty($_POST['h_ret']) || empty($_POST['arr_ret']) || empty($_SESSION['id_etu'])) {
    $erreur = new pronote_management();
    $erreur->setMessage('Formulaire incomplet','index.php');
}else{

// Creation d'un nouvel objet "retard" de type "retard" avec l'envoie des données
$retard = new retard([
    'idutilisateur' => $_SESSION['id_etu'],
    'date_ret' => $_POST['date_ret'],
    'h_ret' => $_POST['h_ret'],
    'arr_ret' => $_POST['arr_ret'],
]);

// Creation d'un nouvel objet "add" de type "retard_management"
$add = new retard_management();
// Execution de la fonction addRetard avec l'envoie des données de ($retard)
$add->addRetard($retard);}