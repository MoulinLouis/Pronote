<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/pronote_management.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/connexionpdo.php');

Class retard_management extends pronote_management {

    // Fonction permettant d'ajouter un retard
    public function addRetard(retard $donnees) {
        $pdo=new connexionpdo();
        $prepare=$pdo->pdo_start()->prepare("INSERT INTO retard (id_utilisateur, date_ret, h_ret, arr_ret) VALUES (?,?,?,?)");
        $prepare->execute([
            $donnees->getIdutilisateur(),
            $donnees->getDate_ret(),
            $donnees->getH_ret(),
            $donnees->getArr_ret()
        ]);
        $this->setMessage('Retard ajouté','index.php');
    }

    public function afficherRetard() {
        $pdo=new connexionpdo();
        $prepare=$pdo->pdo_start()->prepare("SELECT * FROM retard WHERE id_utilisateur = ?");
        $prepare->execute([
            $_COOKIE['user']
        ]);
        $result=$prepare->fetchAll();
        return $result;
    }
}