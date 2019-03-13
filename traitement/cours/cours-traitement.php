<?php
// Début de la SESSION
session_start();
// Inclusion des classes "pronote_management.php", "absence_management.php" et "absence.php"
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/cours/cours.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/cours/cours_management.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/pronote_management.php');

// Vérification des accès a la page
if(empty($_COOKIE['user']) || $_COOKIE['poste'] == 'ETU') {
    $erreur = new pronote_management();
    $erreur->setMessage('Vous n\'avez pas accès a cette page','index.php');
}
// Vérification pour savoir si le formulaire a bien été remplit
elseif(empty($_POST['titrecours']) || empty($_POST['textecours']) || empty($_POST['datecours'])) {
    $erreur = new pronote_management();
    $erreur->setMessage('Formulaire incomplet','index.php');
}else{

// Creation d'un nouvel objet "user" de type "cours" avec l'envoie des POST
$user = new cours([
    'titrecours' => $_POST['titrecours'],
    'textecours' => $_POST['textecours'],
    'datecours' => $_POST['datecours'],
    'idutilisateur' => $_COOKIE['user']
]);

// Creation d'un nouvel objet "cours" de type "cours_management"
$cours = new cours_management();
// Execution de la fonction ajouterCours avec l'envoie des données de ($user)
$cours->ajouterCours($user);}

