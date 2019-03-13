<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/pronote.php');

Class Classe extends pronote {

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

    public function getClasse() { return $this->_classe; }
    public function getNomclasse() { return $this->_nomclasse; }

    public function setClasse($classe) {
        if ($classe >= 0 && $classe <= 100) {
            $this->_classe=$classe;
        } else { $this->setMessage('Champs incorrect','index.php'); }
    }
    public function setNomclasse($nomclasse) {
        if (is_string($nomclasse) && strlen($nomclasse) <= 50) {
            $this->_nomclasse=$nomclasse;
        } else { $this->setMessage('Champs incorrect','index.php'); }
    }

}