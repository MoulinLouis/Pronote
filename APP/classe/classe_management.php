<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/pronote_management.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/connexionpdo.php');

Class classe_management extends pronote_management {

    public function ajouterClasse(classe $donnees) {
        $pdo=new connexionpdo();
        $prepare = $pdo->pdo_start()->prepare("INSERT INTO classe (nom_classe) VALUES (?)");
        $prepare->execute([
            $donnees->getNomclasse()
        ]);
        $this->setMessage('Ajout d\'une classe reussit','vue/classe/liste_classe.php');
    }

    public function afficherClasse() {
        $pdo=new connexionpdo();
        $prepare = $pdo->pdo_start()->prepare("SELECT * FROM classe");
        $prepare->execute();
        $result = $prepare->fetchAll();
        return $result;
    }

    public function modifierClasse(classe $donnees) {
        $pdo=new connexionpdo();
        $prepare=$pdo->pdo_start()->prepare("UPDATE classe SET nom_classe = ? WHERE id_classe=?");
        $prepare->execute([
            $donnees->getNomclasse(),
            $donnees->getClasse()
        ]);
        $this->setMessage('Modification de la classe reussit','vue/classe/liste_classe.php');
    }

    public function supprimerClasse($id_classe) {
        $pdo=new connexionpdo();
        $prepare=$pdo->pdo_start()->prepare("DELETE FROM classe WHERE id_classe=?");
        $prepare->execute([
            $id_classe
        ]);
    $this->setMessage('Suppression de la classe reussit','vue/classe/liste_classe.php');
    }

    public function getClasse($id_classe) {
        $pdo=new connexionpdo();
        $prepare=$pdo->pdo_start()->prepare("SELECT * FROM classe WHERE id_classe=?");
        $prepare->execute([
            $id_classe
        ]);
        $result=$prepare->fetch();
        return $result;
    }


}



?>