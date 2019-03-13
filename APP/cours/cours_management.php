<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/pronote_management.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/connexionpdo.php');

Class cours_management extends pronote_management {

    // Fonction permettant la modification d'un Cours
    public function modifCours(cours $donnees){
        $pdo=new connexionpdo();
        $prepare=$pdo->pdo_start()->prepare("UPDATE cours SET titre = ?, texte = ?, date_cours = ? WHERE id_cours=?");
        $prepare->execute([
            $donnees->getTitrecours(),
            $donnees->getTextecours(),
            $donnees->getDatecours(),
            $donnees->getIdcours()
        ]);
        $this->setMessage('Modification du cours réussit','vue/cours/cours.php');
    }

    // Fonction permettant de supprimer un cours
    public function supprimerCours(cours $donnees) {
        $pdo=new connexionpdo();
        $prepare=$pdo->pdo_start()->prepare("DELETE FROM cours WHERE id_cours=?");
        $prepare->execute([
            $donnees->getIdcours()
        ]);
        $this->setMessage('Suppression du cours reussit','vue/cours/cours.php');
    }

    // Fonction permettant d'avoir les informations des Cours
    public function getCours($id_cours) {
        $pdo=new connexionpdo();
        $prepare=$pdo->pdo_start()->prepare("SELECT * FROM cours WHERE id_cours=?");
        $prepare->execute([
            $id_cours
        ]);
        $result=$prepare->fetch();
        return $result;
    }


    // Fonction permettant d'ajouter un cours
    public function ajouterCours(cours $donnees) {
        $pdo=new connexionpdo();
        // Classe a recuperer en mettant un SELECT dans la 1ere valeur (classe) en récupérant la classe du prof via l'id
        $prepare=$pdo->pdo_start()->prepare("INSERT INTO cours (id_classe, id_profs, titre, texte, date_cours) VALUES (?,?,?,?,?)");
        $prepare->execute([
            $this->recupClasse($donnees->getIdutilisateur()),
            $donnees->getIdutilisateur(),
            $donnees->getTitrecours(),
            $donnees->getTextecours(),
            $donnees->getDatecours()
        ]);
        $this->setMessage('Ajout d\'un cours reussit','vue/cours/cours.php');
    }

}