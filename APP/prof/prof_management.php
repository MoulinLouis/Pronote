<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/pronote_management.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/connexionpdo.php');

Class prof_management extends pronote_management {

    // Fonction permettant l'ajout d'un professeur
    public function addProf(prof $donnees) {
        $pdo=new connexionpdo();
        // Requete permettant l'ajout d'un utilisateur
        $prepare = $pdo->pdo_start()->prepare("INSERT INTO utilisateurs (nom, prenom , classe, email, mdp, poste, id_matiere) VALUES (?,?,?,?,?,?,?)");
        $prepare->execute([
            $donnees->getNom(),
            $donnees->getPrenom(),
            $donnees->getClasse(),
            $donnees->getEmail(),
            $donnees->getMdp(),
            'PRO',
            $donnees->getIdmatiere()]);
        $this->setMessage('Ajout d\'un professeur reussit','vue/prof/liste_prof.php');
    }

    // Fonction permettant d'avoir l'espace membre des professeurs
    public function membreProf() {
        $id=$_COOKIE['user'];
        $pdo=new connexionpdo();
        $prepare = $pdo->pdo_start()->prepare("SELECT * FROM utilisateurs WHERE id_utilisateur=$id");
        $prepare->execute();
        $result=$prepare->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    // Fonction permettant d'avoir la liste des professeurs pour la direction avec bouton Modifier/Supprimer
    public function adminProf() {
        $pdo=new connexionpdo();
        $prepare = $pdo->pdo_start()->prepare("SELECT * FROM utilisateurs WHERE poste =?");
        $prepare->execute([
            'PRO',
        ]);
        $result=$prepare->fetchAll(2);
        return $result;
    }

    // Fonction permettant d'avoir les informations d'un professeur
    public function getProf($id_pro) {
        $pdo=new connexionpdo();
        $prepare=$pdo->pdo_start()->prepare("SELECT * FROM utilisateurs WHERE id_utilisateur=?");
        $prepare->execute([
            $id_pro
        ]);
        $result=$prepare->fetch();
        return $result;
    }

    // Fonction permettant la modification d'un professeur
    public function modifProf(prof $donnees){
        $pdo=new connexionpdo();
        $prepare=$pdo->pdo_start()->prepare("UPDATE utilisateurs SET nom = ?, prenom = ?, email = ?, classe = ?, id_matiere = ? WHERE id_utilisateur=?");
        $prepare->execute([
            $donnees->getNom(),
            $donnees->getPrenom(),
            $donnees->getEmail(),
            $donnees->getClasse(),
            $donnees->getIdmatiere(),
            $donnees->getIdutilisateur()
        ]);
        $this->setMessage('modification du professeur reussit','vue/prof/liste_prof.php');
    }


}