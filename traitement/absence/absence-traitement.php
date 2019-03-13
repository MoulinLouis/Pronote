<?php
// Début de la SESSION
session_start();
// Inclusion des classes "pronote_management.php", "absence_management.php" et "absence.php"
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/pronote_management.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/absence/absence_management.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/absence/absence.php');


// Vérification des accès a la page
if(empty($_COOKIE['user']) || $_COOKIE['poste'] == 'ETU') {
    $erreur = new pronote_management();
    $erreur->setMessage('Vous n\'avez pas accès a cette page','index.php');
}
// Vérification pour savoir si l'utilisateur est bien connecté et que le POST "dateabs" soit bien présent
elseif(empty($_POST['id_etu']) || empty($_POST['dateabs'])) {
    $erreur = new pronote_management();
    $erreur->setMessage('Formulaire incomplet ou utilisateur introuvable','index.php');
}else{

// Creation d'un nouvel objet "user" de type "absence" avec l'envoie de "idutilisateur" et "dateabs"
$user = new absence([
    'idutilisateur' => $_POST['id_etu'],
    'dateabs' => $_POST['dateabs']
]);

// Creation d'un nouvel objet "absence" de type "absence_management"
$absence = new absence_management();
// Execution de la fonction addAbsence avec l'envoie des données de ($user)
$absence->addAbsence($user); }