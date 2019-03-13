<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/pronote.php');

Class Matiere extends pronote {

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

    public function getIdmatiere() { return $this->_idmatiere; }
    public function getNommatiere() { return $this->_nommatiere; }

    public function setIdmatiere($idmatiere) {
        if ($idmatiere >= 0 && $idmatiere <= 100) {
            $this->_idmatiere=$idmatiere;
        } else { $this->setMessage('Champs incorrect','index.php'); }
    }

    public function setNommatiere($nommatiere) {
        if (is_string($nommatiere) && strlen($nommatiere) <= 50) {
            $this->_nommatiere=$nommatiere;
        } else { $this->setMessage('Champs incorrect','index.php'); }
    }

}