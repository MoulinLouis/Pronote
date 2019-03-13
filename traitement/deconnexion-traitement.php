<?php
// Début de la SESSION
session_start();
// Inclusion de la classe "pronote_management.php"
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/pronote_management.php');

// Vérification des accès a la page
if(empty($_COOKIE['user'])) {
    $erreur = new pronote_management();
    $erreur->setMessage('Vous ête déja déconnecté','index.php');
}else{
// Creation d'un nouvel objet "deco" de type "pronote-management"
$deco = new pronote_management();
// Execution de la fonction deconnexion
$deco->deconnexion();}
?>