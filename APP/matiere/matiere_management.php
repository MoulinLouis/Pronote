<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/pronote_management.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/connexionpdo.php');

Class matiere_management extends pronote_management {

    public function ajouterMatiere(matiere $donnees) {
        $pdo=new connexionpdo();
        $prepare = $pdo->pdo_start()->prepare("INSERT INTO matiere (nom_matiere) VALUES (?)");
        $prepare->execute([
            $donnees->getNommatiere()
        ]);
        var_dump($donnees);
        $this->setMessage('Ajout d\'une matiere reussit','vue/matiere/liste_matiere.php');
    }

    public function afficherMatiere() {
        $pdo=new connexionpdo();
        $prepare = $pdo->pdo_start()->prepare("SELECT * FROM matiere");
        $prepare->execute();
        $result = $prepare->fetchAll();
        return $result;
    }

    public function modifierMatiere(matiere $donnees) {
        $pdo=new connexionpdo();
        $prepare=$pdo->pdo_start()->prepare("UPDATE matiere SET nom_matiere = ? WHERE id_matiere=?");
        $prepare->execute([
            $donnees->getNommatiere(),
            $donnees->getIdmatiere()
        ]);
        $this->setMessage('Modification dune matiere reussit','vue/matiere/liste_matiere.php');
    }

    public function supprimerMatiere($id_matiere) {
        $pdo=new connexionpdo();
        $prepare=$pdo->pdo_start()->prepare("DELETE FROM matiere WHERE id_matiere=?");
        $prepare->execute([
            $id_matiere
        ]);
        $this->setMessage('Suppression d\'une matiere reussit','vue/matiere/liste_matiere.php');
    }

    public function getMatiere($id_matiere) {
        $pdo=new connexionpdo();
        $prepare=$pdo->pdo_start()->prepare("SELECT * FROM matiere WHERE id_matiere=?");
        $prepare->execute([
            $id_matiere
        ]);
        $result=$prepare->fetch();
        return $result;
    }


}



?>