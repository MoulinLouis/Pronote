<?php
// Début de la SESSION
session_start();
// Inclusion des classes "pronote_management.php", "direction_management.php" et "direction.php"
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/pronote_management.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/matiere/matiere_management.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/matiere/matiere.php');

// Vérification des accès a la page
if(empty($_COOKIE['user']) || $_COOKIE['poste'] == 'PRO' || $_COOKIE['poste'] == 'ETU') {
    $erreur = new pronote_management();
    $erreur->setMessage('Vous n\'avez pas accès a cette page','index.php');
}
// Vérification pour savoir si le formulaire a bien été remplit
elseif(empty($_POST['nom_matiere']) || empty($_POST['id_matiere'])) {
    $erreur = new pronote_management();
    $erreur->setMessage('Formulaire incomplet ou matiere introuvable','index.php');
}else{

$matiere = new matiere([
    'nommatiere' => $_POST['nom_matiere'],
    'idmatiere' => $_POST['id_matiere']
]);

// Creation d'un nouvel objet "user" de type "direction" avec l'envoie des données


// Creation d'un nouvel objet "add" de type "etudiant_management"
$add = new matiere_management();
// Execution de la fonction addDir avec l'envoie des données de ($user)
$add->modifierMatiere($matiere);}


