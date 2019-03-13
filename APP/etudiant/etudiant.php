<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/pronote.php');

Class etudiant extends pronote {

    public function __construct(array $donnees) {
        $this->hydrate($donnees);
    }

    public function hydrate(array $donnees) {
        foreach ($donnees as $key => $value) {
            $method = 'set'.ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function getIdutilisateur() { return $this->_idutilisateur; }
    public function getNom() { return $this->_nom; }
    public function getPrenom() { return $this->_prenom; }
    public function getEmail() { return $this->_email; }
    public function getMdp() { return $this->_mdp; }
    public function getClasse() { return $this->_classe; }




}
?>