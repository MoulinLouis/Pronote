<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/connexionpdo.php');

class pronote_management
{
    public function __construct()
    {

    }

    // Fonction permettant la connexion d'un utilisateur
    public function login(pronote $donnees) {
        $pdo=new connexionpdo();
        $prepare = $pdo->pdo_start()->prepare("SELECT * FROM utilisateurs WHERE email = ? AND mdp = ?");
        $prepare->execute([
            $donnees->getEmail(),
            $donnees->getMdp()
        ]);
        $result = $prepare->fetch(PDO::FETCH_ASSOC);
        if($result) {
            setcookie('user', $result['id_utilisateur'], time() + 86400*10, '/');
            setcookie('poste', $result['poste'], time() + 86400*10, '/');
            $this->setMessage('Connexion effectué','index.php');
        } else {
            $this->setMessage('Connexion impossible','index.php');
        }
    }

    // Fonction permettant la deconnexion d'un utilisateur
    public function deconnexion()
    {
        setcookie('user', $result['id_utilisateur'], time()-1, '/');
        setcookie('poste', $result['poste'], time()-1, '/');
        $this->setMessage('Deconnexion effectué','index.php');
    }



    // Fonction permettant de recuperer la classe de l'utilisateur
    public function recupClasse($classe) {
        $pdo=new connexionpdo();
        $prepare=$pdo->pdo_start()->prepare("SELECT classe FROM utilisateurs WHERE id_utilisateur=?");
        $prepare->execute([
                $classe
        ]);
        $result=$prepare->fetch();
        return $result['classe'];
    }

    // Fonction permettant d'afficher les cours selon l'utilisateur connecté
    public function afficherCours(cours $donnees) {
        $pdo=new connexionpdo();
        $prepare=$pdo->pdo_start()->prepare("SELECT * FROM cours WHERE id_classe=(SELECT classe FROM utilisateurs WHERE id_utilisateur=?)");
        $prepare->execute(([
                $donnees->getIdutilisateur()
        ]));
        $result=$prepare->fetchAll();
        return $result;
    }

    // Fonction permettant de faire un menu deroulant de la classe
    public function deroulantClasse() {
        $pdo=new connexionpdo();
        $prepare = $pdo->pdo_start()->prepare("SELECT * FROM classe");
        $prepare->execute();
        $result = $prepare->fetchAll();
        return $result;
    }

    // Fonction permettant de faire un menu deroulant
    public function deroulantMatiere() {
        $pdo=new connexionpdo();
        $prepare = $pdo->pdo_start()->prepare("SELECT * FROM matiere");
        $prepare->execute();
        $result = $prepare->fetchAll();
        return $result;
    }

    // FOnction permettant de convertir l'id de la matiere en (nom de la matiere)
    public function convertMatiere($matiere) {
        $pdo=new connexionpdo();
        $prepare=$pdo->pdo_start()->prepare("SELECT nom_matiere FROM matiere WHERE id_matiere = '$matiere'");
        $prepare->execute();
        $result=$prepare->fetch();
        return $result['nom_matiere'];
    }

    // Fonction permettant de convertir l'id de la classe en son (nom de la classe)
    public function convertClasse($classe) {
        $pdo=new connexionpdo();
        $prepare=$pdo->pdo_start()->prepare("SELECT nom_classe FROM classe WHERE id_classe='$classe'");
        $prepare->execute();
        $result=$prepare->fetch();
        return $result['nom_classe'];
    }

    // Fonction permettant de supprimer un utilisateur
    public function supprimerUser($iduser){
        $pdo=new connexionpdo();
        $prepare=$pdo->pdo_start()->prepare("DELETE FROM utilisateurs WHERE id_utilisateur=?");
        $prepare->execute([
            $iduser
        ]);
        $prepare=$pdo->pdo_start()->prepare("DELETE FROM absence WHERE id_utilisateur=?");
        $prepare->execute([
            $iduser
        ]);
        $prepare=$pdo->pdo_start()->prepare("DELETE FROM retard WHERE id_utilisateur=?");
        $prepare->execute([
            $iduser
        ]);
        $this->setMessage('Utilisateur supprime avec succès','index.php');
    }

    public function setMessage($message, $page) {
        $_SESSION['message'] = $message;
        header("location: /pronote/$page");
    }

    public function getMessage() {
        if(isset($_SESSION['message'])) { ?>
                <br><div class="alert alert-primary alert-dismissible fade show text-center offset-4 col-md-4 " role="alert">
                    <strong><?php echo $_SESSION['message']; ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php unset($_SESSION['message']);
        }
    }

}