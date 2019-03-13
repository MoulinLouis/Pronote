<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/pronote.php');

Class absence extends pronote {

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
    public function getDateabs() { return $this->_date_abs; }

    public function setDateabs($date_abs) {
        if (is_string($date_abs) && strlen($date_abs) <= 10) {
            $this->_date_abs=$date_abs;
        } else { $this->setMessage('Champs incorrect','index.php'); }
    }
}
?>