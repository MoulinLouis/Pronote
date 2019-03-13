<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/pronote_management.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/connexionpdo.php');

Class absence_management extends pronote_management {

    // Fonction permettant d'ajouter une absence
    public function addAbsence(absence $donnees) {
        $pdo=new connexionpdo();
        $prepare=$pdo->pdo_start()->prepare("INSERT INTO absence (id_utilisateur, date_abs) VALUES (?,?)");
        $prepare->execute([
            $donnees->getIdutilisateur(),
            $donnees->getDateabs()
        ]);
        $this->setMessage('Ajout d\'une absence reussit','/index.php');
    }

    public function afficherAbsence() {
            $pdo=new connexionpdo();
            $prepare=$pdo->pdo_start()->prepare("SELECT * FROM absence WHERE id_utilisateur = ?");
            $prepare->execute([
                $_COOKIE['user']
            ]);
        $result=$prepare->fetchAll();
        return $result;
    }


}