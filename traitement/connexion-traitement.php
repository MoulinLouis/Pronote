<?php
// Début de la SESSION
session_start();
// Inclusion des classes "pronote_management.php", "absence_management.php" et "absence.php"
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/pronote_management.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/etudiant/etudiant.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/etudiant/etudiant_management.php');


// Vérification pour savoir si le formulaire a bien été remplit
if(empty($_POST['email']) || empty($_POST['mdp'])) {
    $erreur = new pronote_management();
    $erreur->setMessage('Formulaire incomplet','index.php');
}else{

// Creation d'un nouvel objet "user" de type "absence" avec l'envoie de "idutilisateur" et "dateabs"
$user = new etudiant([
    'email' => $_POST['email'],
    'mdp' => $_POST['mdp']
]);

// Creation d'un nouvel objet "login" de type "pronote_management"
$login = new pronote_management();
// Execution de la fonction login avec l'envoie des données de ($user)
$login->login($user);}


