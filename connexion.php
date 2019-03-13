<?php
session_start();
include($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/pronote_management.php');
include($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/include/header.php');
include($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/include/style.php');

// Création d'un objet "Message" de type "pronote_management"
$Message = new pronote_management();
// Execution de la fonction getMessage
$Message->getMessage();

// Vérification des accès a la page
if(isset($_COOKIE['user'])) {
    $erreur = new pronote_management();
    $erreur->setMessage('Vous ête déja connecté','index.php');
} else {
?>

<div class="offset-2 col-md-8 col-xs-2">
    <div class="form-area text-center" style="padding-top:80px;">
        <form id="form-contact" method="POST" action="/pronote/traitement/connexion-traitement.php">
            <h3 style="margin-bottom: 25px; text-align: center;">Formulaire de connexion</h3>
            <div class="form-group">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="mdp" name="mdp" placeholder="Mot de passe" required>
            </div>
            <button type="submit" id="submit" name="submit" class="btn btn-primary">Se connecter</button>
        </form>
    </br>
        <form>
            <input class="btn btn-secondary" type="button" value="Retour" onclick="history.go(-1)">
        </form>
    </div>
</div>

<?php }
include($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/include/footer.php');
?>