<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/pronote.php');

Class retard extends pronote {

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
    public function getDate_ret() { return $this->_date_ret; }
    public function getH_ret() { return $this->_h_ret; }
    public function getArr_ret() { return $this->_arr_ret; }

    public function setDate_ret($date_ret) {
        if (is_string($date_ret) && strlen($date_ret) <= 255) {
            $this->_date_ret=$date_ret;
        }else { $this->setMessage('Champs incorrect','index.php'); }
    }

    public function setH_ret($h_ret){
        if (is_string($h_ret) && strlen($h_ret) <= 255) {
            $this->_h_ret=$h_ret;
        } else { $this->setMessage('Champs incorrect','index.php'); }
    }

    public function setArr_ret($arr_ret) {
        if (is_string($arr_ret) && strlen($arr_ret) <= 255) {
            $this->_arr_ret=$arr_ret;
        } else { $this->setMessage('Champs incorrect','index.php'); }
    }
}
?>