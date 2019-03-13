<?php
// Début de la SESSION
session_start();
// Inclusion des classes "pronote_management.php", "pronote_management.php"
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/pronote_management.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/matiere/matiere_management.php');

// Vérification des accès a la page
if(empty($_COOKIE['user']) || $_COOKIE['poste'] == 'PRO' || $_COOKIE['poste'] == 'ETU') {
    $erreur = new pronote_management();
    $erreur->setMessage('Vous n\'avez pas accès a cette page','index.php');
} elseif(empty($_GET['id_matiere'])) {
    $erreur = new pronote_management();
    $erreur->setMessage('Vous n\'avez selectionné aucune matiere','index.php');
}else{
// Creation d'un nouvel objet "deco" de type "pronote_management"
    $delete = new matiere_management();
// Execution de la fonction supprimerUser avec l'envoie des données de ($_GET['id_user']) = utilisateur selectionné
    $delete->supprimerMatiere($_GET['id_matiere']);
}
?>