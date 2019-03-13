<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/pronote.php');

Class cours extends pronote {

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
    public function getTitrecours() { return $this->_titrecours; }
    public function getTextecours() { return $this->_textecours; }
    public function getDatecours() { return $this->_datecours; }
    public function getIdcours() { return $this->_idcours; }

    public function setIdutilisateur($idutilisateur) {
        if ($idutilisateur >= 0 && $idutilisateur <= 100) {
            $this->_idutilisateur = $idutilisateur;
        } else { $this->setMessage('Champs incorrect','index.php'); }
    }
    public function setTitrecours($titrecours) {
        if (is_string($titrecours) && strlen($titrecours) <= 30) {
            $this->_titrecours=$titrecours;
        } else { $this->setMessage('Champs incorrect','index.php'); }
    }
    public function setTextecours($textecours) {
        if (is_string($textecours) && strlen($textecours) <= 255) {
            $this->_textecours=$textecours;
        } else { $this->setMessage('Champs incorrect','index.php'); }
    }
    public function setDatecours($datecours) {
        if (is_string($datecours) && strlen($datecours) <= 255) {
            $this->_datecours=$datecours;
        }  else { $this->setMessage('Champs incorrect','index.php'); }
    }
    public function setIdcours($idcours) {
        if ($idcours >= 0 && $idcours <= 100) {
            $this->_idcours = $idcours;
        } else { $this->setMessage('Champs incorrect','index.php'); }
    }

}
?>