<?php
// Début de la SESSION
session_start();
// Inclusion des classes "pronote_management.php", "etudiant_management.php" et "etudiant.php"
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/etudiant/etudiant.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/etudiant/etudiant_management.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/pronote_management.php');

// Vérification des accès a la page
if(empty($_COOKIE['user']) || $_COOKIE['poste'] == 'PRO' || $_COOKIE['poste'] == 'ETU') {
    $erreur = new pronote_management();
    $erreur->setMessage('Vous n\'avez pas accès a cette page','index.php');
}
// Vérification pour savoir si le formulaire a bien été remplit
elseif(empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['email']) || empty($_POST['classe']) || empty($_POST['id_etu'])) {
    $erreur = new pronote_management();
    $erreur->setMessage('Formulaire incomplet','index.php');
}else{

// Creation d'un nouvel objet "user" de type "etudiant" avec l'envoie des données
$user = new etudiant([
    'nom' => $_POST['nom'],
    'prenom' => $_POST['prenom'],
    'email' => $_POST['email'],
    'classe' => $_POST['classe'],
    'idutilisateur' => $_POST['id_etu']
]);

// Creation d'un nouvel objet "modif" de type "etudiant_management"
$modif = new etudiant_management();
// Execution de la fonction modifEtudiant avec l'envoie des données de ($user)
$modif->modifEtudiant($user);}