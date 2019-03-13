<?php
// Début de la SESSION
session_start();
// Inclusion des classes "pronote_management.php", "cours_management.php" et "cours.php"
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/cours/cours.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/cours/cours_management.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/pronote_management.php');

// Vérification des accès a la page
if(empty($_COOKIE['user']) || $_COOKIE['poste'] == 'ETU') {
    $erreur = new pronote_management();
    $erreur->setMessage('Vous n\'avez pas accès a cette page','index.php');
}
// Vérification pour savoir si le formulaire a bien été remplit
elseif(empty($_POST['titre']) || empty($_POST['texte']) || empty($_POST['date_cours']) || empty($_POST['id_cours'])) {
    $erreur = new pronote_management();
    $erreur->setMessage('Formulaire incomplet ou cours introuvable','index.php');
}else{
// Creation d'un nouvel objet "user" de type "cours" avec l'envoie des données
$user = new cours([
    'titrecours' => $_POST['titre'],
    'textecours' => $_POST['texte'],
    'datecours' => $_POST['date_cours'],
    'idcours' => $_POST['id_cours']
]);

// Creation d'un nouvel objet "modif" de type "cours_management"
$modif = new cours_management();
// Execution de la fonction modifCours avec l'envoie des données de ($user)
$modif->modifCours($user);}