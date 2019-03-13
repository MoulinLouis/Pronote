<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/pronote_management.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/connexionpdo.php');

Class etudiant_management extends pronote_management {

    // Fonction permettant l'ajout d'un Etudiant
    public function addEtudiant(etudiant $donnees) {
    $pdo=new connexionpdo();
    $prepare = $pdo->pdo_start()->prepare("INSERT INTO utilisateurs (nom, prenom, email, mdp, classe) VALUES (?,?,?,?,?)");
    $prepare->execute([
        $donnees->getNom(),
        $donnees->getPrenom(),
        $donnees->getEmail(),
        $donnees->getMdp(),
        $donnees->getClasse()
    ]);
        $this->setMessage('Inscription reussit','/index.php');
}

    // Fonction permettant d'avoir l'espace membre des Etudiants
    public function membreEtudiant() {
        $id=$_COOKIE['user'];
        $pdo=new connexionpdo();
        $prepare = $pdo->pdo_start()->prepare("SELECT * FROM utilisateurs WHERE id_utilisateur=$id");
        $prepare->execute();
        $result=$prepare->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    // Fonction permettant d'avoir la liste des Etudiants avec des boutons Retard/Absence
    public function listeEtudiant() {
        $pdo=new connexionpdo();
        $prepare = $pdo->pdo_start()->prepare("SELECT * FROM utilisateurs WHERE poste =? AND classe=?");
        $prepare->execute([
            'ETU',
            $this->recupClasse($_COOKIE['user'])
        ]);
        $result=$prepare->fetchAll(2);
        return $result;
    }

    // Fonction permettant d'avoir les informations d'un étudiant
    public function getEtudiant($id_etu) {
        $pdo=new connexionpdo();
        $prepare=$pdo->pdo_start()->prepare("SELECT * FROM utilisateurs WHERE id_utilisateur=?");
        $prepare->execute([
            $id_etu
        ]);
        $result=$prepare->fetch();
        return $result;
    }

    // Fonction permettant la modification d'un étudiant
    public function modifEtudiant(etudiant $donnees){
        $pdo=new connexionpdo();
        $prepare=$pdo->pdo_start()->prepare("UPDATE utilisateurs SET nom = ?, prenom = ?, email = ?, classe = ? WHERE id_utilisateur=?");
        $prepare->execute([
            $donnees->getNom(),
            $donnees->getPrenom(),
            $donnees->getEmail(),
            $donnees->getClasse(),
            $donnees->getIdutilisateur()
        ]);
        $this->setMessage('Modification de l\'étudiant réussit','vue/etudiant/liste_etudiant.php');
    }

    // Fonction permettant d'avoir la liste des eleves pour la direction avec bouton Modifier/Supprimer
    public function adminEtudiant() {
        $pdo=new connexionpdo();
        $prepare = $pdo->pdo_start()->prepare("SELECT * FROM utilisateurs WHERE poste =?");
        $prepare->execute([
            'ETU',
        ]);
        $result=$prepare->fetchAll(2);
        return $result;
    }
}