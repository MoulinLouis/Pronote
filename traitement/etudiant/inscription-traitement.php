<?php
// Début de la SESSION
session_start();
// Inclusion des classes "pronote_management.php", "etudiant_management.php" et "etudiant.php"
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/pronote_management.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/etudiant/etudiant.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/etudiant/etudiant_management.php');

// Vérification des accès a la page
if(isset($_COOKIE['user']) || $_COOKIE['poste'] == 'PRO') {
    $erreur = new pronote_management();
    $erreur->setMessage('Vous n\'avez pas accès a cette page','index.php');
}
// Vérification pour savoir si le formulaire a bien été remplit
elseif(empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['email']) || empty($_POST['mdp1']) || empty($_POST['mdp2']) || empty($_POST['classe'])) {
    $erreur = new pronote_management();
    $erreur->setMessage('Formulaire incomplet','vue/index.php');
}
// Vérification du mot de passe 1 avec le 2 pour qu'il soit identique
elseif($_POST['mdp1'] != $_POST['mdp2']) {
    $erreur = new pronote_management();
    $erreur->setMessage('Les deux mots de passe ne sont pas identique','index.php');
}else {

// Creation d'un nouvel objet "user" de type "etudiant" avec l'envoie des données
    $user = new etudiant([
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'email' => $_POST['email'],
        'mdp' => $_POST['mdp1'],
        'classe' => $_POST['classe']
    ]);

// Creation d'un nouvel objet "add" de type "etudiant_management"
    $add = new etudiant_management();
// Execution de la fonction addEtudiant avec l'envoie des données de ($user)
    $add->addEtudiant($user);
}
