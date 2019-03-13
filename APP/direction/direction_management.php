<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/pronote_management.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/connexionpdo.php');

Class direction_management extends pronote_management {

    // Fonction permettant l'ajout direction
    public function addDir(direction $donnees) {
        $pdo=new connexionpdo();
        // Requete permettant l'ajout d'un utilisateur
        $prepare = $pdo->pdo_start()->prepare("INSERT INTO utilisateurs (nom, prenom , email, mdp, poste) VALUES (?,?,?,?,?)");
        $prepare->execute([
            $donnees->getNom(),
            $donnees->getPrenom(),
            $donnees->getEmail(),
            $donnees->getMdp(),
            'DIR']);
        $this->setMessage('Ajout d\'un directeur reussit','vue/direction/liste_direction.php');
    }

    // Fonction permettant d'avoir l'espace membre de la direction
    public function membreDirection() {
        $id=$_COOKIE['user'];
        $pdo=new connexionpdo();
        $prepare=$pdo->pdo_start()->prepare("SELECT * FROM utilisateurs WHERE id_utilisateur=$id");
        $prepare->execute();
        $result=$prepare->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    // Fonction permettant d'avoir la liste des directeurs avec bouton Modifier/Supprimer
    public function adminDir() {
        $pdo=new connexionpdo();
        $prepare = $pdo->pdo_start()->prepare("SELECT * FROM utilisateurs WHERE poste =?");
        $prepare->execute([
            'DIR',
        ]);
        $result=$prepare->fetchAll(2);
        return $result;
    }

    public function getDir($id_dir) {
        $pdo=new connexionpdo();
        $prepare=$pdo->pdo_start()->prepare("SELECT * FROM utilisateurs WHERE id_utilisateur=?");
        $prepare->execute([
            $id_dir
        ]);
        $result=$prepare->fetch();
        return $result;
    }

    // Fonction permettant la modification d'un directeur
    public function modifDir(direction $donnees){
        $pdo=new connexionpdo();
        $prepare=$pdo->pdo_start()->prepare("UPDATE utilisateurs SET nom = ?, prenom = ?, email = ? WHERE id_utilisateur=?");
        $prepare->execute([
            $donnees->getNom(),
            $donnees->getPrenom(),
            $donnees->getEmail(),
            $donnees->getIdutilisateur()
        ]);
        $this->setMessage('Modification du directeur reussit','vue/direction/liste_direction.php');
    }
}