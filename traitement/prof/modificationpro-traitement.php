<?php
// Début de la SESSION
session_start();
// Inclusion des classes "pronote_management.php", "prof_management.php" et "prof.php"
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/prof/prof.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/prof/prof_management.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/pronote_management.php');

// Vérification des accès a la page
if(empty($_COOKIE['user']) || $_COOKIE['poste'] == 'PRO' || $_COOKIE['poste'] == 'ETU') {
    $erreur = new pronote_management();
    $erreur->setMessage('Vous n\'avez pas accès a cette page','index.php');
}
// Vérification pour savoir si le formulaire a bien été remplit
elseif(empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['email']) || empty($_POST['classe']) || empty($_POST['matiere'])) {
    $erreur = new pronote_management();
    $erreur->setMessage('Formulaire incomplet ou professeur introuvable','index.php');
}else{

// Creation d'un nouvel objet "user" de type "prof" avec l'envoie des données
$user = new prof([
    'nom' => $_POST['nom'],
    'prenom' => $_POST['prenom'],
    'email' => $_POST['email'],
    'classe' => $_POST['classe'],
    'idmatiere' => $_POST['matiere'],
    'idutilisateur' => $_POST['id_pro']
]);

// Creation d'un nouvel objet "modif" de type "prof_management"
$modif = new prof_management();
// Execution de la fonction modifProf avec l'envoie des données de ($user)
$modif->modifProf($user);}