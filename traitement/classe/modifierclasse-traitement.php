<?php
// Début de la SESSION
session_start();
// Inclusion des classes "pronote_management.php", "direction_management.php" et "direction.php"
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/pronote_management.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/classe/classe.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/classe/classe_management.php');

// Vérification des accès a la page
if(empty($_COOKIE['user']) || $_COOKIE['poste'] == 'PRO' || $_COOKIE['poste'] == 'ETU') {
    $erreur = new pronote_management();
    $erreur->setMessage('Vous n\'avez pas accès a cette page','index.php');
}
// Vérification pour savoir si le formulaire a bien été remplit
elseif(empty($_POST['classe'])) {
    $erreur = new pronote_management();
    $erreur->setMessage('Formulaire incomplet','index.php');
}else {

// Creation d'un nouvel objet "user" de type "classe" avec l'envoie des données
    $user = new classe([
        'nomclasse' => $_POST['classe'],
        'classe' => $_POST['id_classe']
    ]);


// Creation d'un nouvel objet "add" de type "etudiant_management"
    $add = new classe_management();
// Execution de la fonction addDir avec l'envoie des données de ($user)
    $add->modifierClasse($user);

}

