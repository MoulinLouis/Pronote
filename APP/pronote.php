<?php
require_once ('connexionpdo.php');
Class pronote {
    public $_idutilisateur, $_nom, $_prenom, $_email, $_mdp, $_poste, $_classe, $_idmatiere, $_idposte, $_titrecours, $_textecours, $_datecours, $_date_ret, $_arr_ret, $_h_ret, $_date_abs, $_idcours, $_nomclasse, $_nommatiere;



    public function setIdutilisateur($idutilisateur) {
        if ($idutilisateur >= 0 && $idutilisateur <= 100) {
            $this->_idutilisateur = $idutilisateur;
        } else { $this->setMessage('Champs incorrect','index.php'); }
    }

    public function setNom($nom) {
        if (is_string($nom) && strlen($nom) <= 30) {
            $this->_nom = $nom;
        } else { $this->setMessage('Champs incorrect','index.php'); }
    }

    public function setPrenom($prenom) {
        if (is_string($prenom) && strlen($prenom) <= 30) {
            $this->_prenom = $prenom;
        } else { $this->setMessage('Champs incorrect','index.php'); }
    }

    public function setEmail($email) {
        if (is_string($email) && strlen($email) <= 30) {
            $this->_email = $email;
        } else { $this->setMessage('Champs incorrect','index.php'); }
    }

    public function setMdp($mdp) {
        if (is_string($mdp) && strlen($mdp) <= 30) {
            $this->_mdp = $mdp;
        } else { $this->setMessage('Champs incorrect','index.php'); }
    }

    public function setPoste($poste) {
        if (is_string($poste) && strlen($poste) <= 255) {
            $this->_nom = $poste;
        } else { $this->setMessage('Champs incorrect','index.php'); }
    }

    public function setClasse($classe) {
        if ($classe >= 0 && $classe <= 100) {
            $this->_classe=$classe;
        } else { $this->setMessage('Champs incorrect','index.php'); }
    }

    public function setNomclasse($nomclasse) {
        if ($nomclasse >= 0 && $nomclasse <= 100) {
            $this->_nomclasse=$nomclasse;
        } else { $this->setMessage('Champs incorrect','index.php'); }
    }

    public function setIdmatiere($idmatiere) {
        if ($idmatiere >= 0 && $idmatiere <= 100) {
            $this->_idmatiere=$idmatiere;
        } else { $this->setMessage('Champs incorrect','index.php'); }
    }

    public function setIdposte($idposte) {
        if ($idposte >= 0 && $idposte <= 100) {
            $this->_idposte=$idposte;
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
        } else { $this->setMessage('Champs incorrect','index.php'); }
    }

    public function setDate_ret($date_ret) {
        if (is_string($date_ret) && strlen($date_ret) <= 255) {
            $this->_date_ret=$date_ret;
        } else { $this->setMessage('Champs incorrect','index.php'); }
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

    public function setDateabs($date_abs) {
        if (is_string($date_abs) && strlen($date_abs) <= 10) {
            $this->_date_abs=$date_abs;
        } else { $this->setMessage('Champs incorrect','index.php'); }
    }

    public function setMessage($message, $page) {
        $_SESSION['message'] = $message;
        header("location: /pronote/$page");
    }
}
?>