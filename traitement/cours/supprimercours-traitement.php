<?php
// Début de la SESSION
session_start();
// Inclusion des classes "cours_management.php" et "cours.php"
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/cours/cours_management.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/cours/cours.php');

// Vérification des accès a la page
if(empty($_COOKIE['user']) || $_COOKIE['poste'] == 'ETU') {
    $erreur = new pronote_management();
    $erreur->setMessage('Vous n\'avez pas accès a cette page','index.php');
}elseif(empty($_GET['id_cours'])) {
    $erreur = new pronote_management();
    $erreur->setMessage('Vous n\'avez selectionné aucun cours','index.php');
}else{

// Creation d'un nouvel objet "cours" de type "cours" avec l'envoie des données du cours selectionné
        $cours = new cours([
            'idcours' => $_GET['id_cours']
        ]);

// Creation d'un nouvel objet "supp" de type "cours_management"
        $supp = new cours_management();
// Execution de la fonction supprimerCours avec l'envoie des données de ($cours) = cours selectionné
        $supp->supprimerCours($cours);
}

?>