<?php
session_start();
include($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/include/header.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/pronote_management.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/pronote.php');

// Vérification des accès a la page
if(empty($_COOKIE['user']) || $_COOKIE['poste'] == 'PRO' || $_COOKIE['poste'] == 'ETU') {
    $erreur = new pronote_management();
    $erreur->setMessage('Vous n\'avez pas accès a cette page','index.php');
}else{
// Création d'un objet "Message" de type "pronote_management"
$Message = new pronote_management();
// Execution de la fonction getMessage
$Message->getMessage();
?>

<div class="offset-2 col-md-8 col-xs-2">
    <div class="form-area text-center">
        <form id="form-contact" method="POST" action="/pronote/traitement/prof/inscriptionprof-traitement.php">
            <br>
            <h3 style="margin-bottom: 25px; text-align: center;">Ajout professeur</h3>
            <div class="form-group">
                <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom" required>
            </div>
            <div class="form-group">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="mdp1" name="mdp1" placeholder="Mot de passe" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="mdp2" name="mdp2" placeholder="Confirmer mot de passe" required>
            </div>
            <div class="form-group">
                <select class="form-control" name="classe">
                    <?php
                    $deroul=new pronote_management();
                    $classes = $deroul->deroulantClasse();

                    foreach($classes as $classe) {
                        echo '<option value="' . $classe['id_classe'] . '" name="classe">' . $classe['nom_classe'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <select class="form-control" name="matiere">
                    <?php
                    $deroul2=new pronote_management();
                    $matieres=$deroul2->deroulantMatiere();

                    foreach($matieres as $matiere) {
                        echo '<option value="' . $matiere['id_matiere'] . '" name="matiere">' . $matiere['nom_matiere'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <button type="submit" id="submit" name="submit" class="btn btn-primary">S'inscrire</button>
        </form>
        <form>
            <input class="btn btn-secondary" type="button" value="Retour" onclick="history.go(-1)">
        </form>
    </div>
</div>
<?php include($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/include/footer.php');}
?>