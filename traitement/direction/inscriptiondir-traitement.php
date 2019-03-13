<?php
// Début de la SESSION
session_start();
// Inclusion des classes "pronote_management.php", "direction_management.php" et "direction.php"
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/pronote_management.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/direction/direction.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/direction/direction_management.php');

// Vérification des accès a la page
if(empty($_COOKIE['user']) || $_COOKIE['poste'] == 'PRO' || $_COOKIE['poste'] == 'ETU') {
    $erreur = new pronote_management();
    $erreur->setMessage('Vous n\'avez pas accès a cette page','index.php');
}
// Vérification pour savoir si le formulaire a bien été remplit
elseif(empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['email']) || empty($_POST['mdp1']) || empty($_POST['mdp2'])) {
    $erreur = new pronote_management();
    $erreur->setMessage('Formulaire incomplet','index.php');
}
// Vérification du mot de passe 1 avec le 2 pour qu'il soit identique
elseif($_POST['mdp1'] != $_POST['mdp2']) {
    $erreur = new pronote_management();
    $erreur->setMessage('Les deux mots ne sont pas identique', 'index.php');
}else{

// Creation d'un nouvel objet "user" de type "direction" avec l'envoie des données
        $user = new direction([
            'nom' => $_POST['nom'],
            'prenom' => $_POST['prenom'],
            'email' => $_POST['email'],
            'mdp' => $_POST['mdp1'],
        ]);

// Creation d'un nouvel objet "add" de type "etudiant_management"
        $add = new direction_management();
// Execution de la fonction addDir avec l'envoie des données de ($user)
        $add->addDir($user);
}
