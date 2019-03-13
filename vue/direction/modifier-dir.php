<?php
session_start();
include($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/include/header.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/direction/direction_management.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/pronote_management.php');

// Vérification des accès a la page
if(empty($_COOKIE['user']) || $_COOKIE['poste'] == 'PRO' || $_COOKIE['poste'] == 'ETU') {
    $erreur = new pronote_management();
    $erreur->setMessage('Vous n\'avez pas accès a cette page','index.php');
}elseif(empty($_GET['id_dir'])) {
    $erreur = new pronote_management();
    $erreur->setMessage('Vous n\'avez selectionné aucun directeur','index.php');
} else{
// Création d'un objet "Message" de type "pronote_management"
        $Message = new pronote_management();
// Execution de la fonction getMessage
        $Message->getMessage();

        if($_GET) {
            $value=new direction_management();
            $result = $value->getDir($_GET['id_dir']);

        }
        ?>

        <div class="offset-2 col-md-8 col-xs-2">
            <div class="form-area text-center">
                <form id="form-contact" method="POST" action="/pronote/traitement/direction/modificationdir-traitement.php">
                    <br>
                    <h3 style="margin-bottom: 25px; text-align: center;">Modification direction</h3>
                    <div class="form-group">
                        <input type="text" name="nom" class="form-control" value="<?php echo $result['nom']; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" name="prenom" class="form-control" value="<?php echo $result['prenom']; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" value="<?php echo $result['email']; ?>">
                    </div>
                    <input type="hidden" name="id_dir" value="<?php echo $_GET['id_dir']?>">
                    <button type="submit" id="submit" name="submit" class="btn btn-primary">Modifier</button>
                </form>
                <form>
                    <input class="btn btn-secondary" type="button" value="Retour" onclick="history.go(-1)">
                </form>
            </div>
        </div>
        <?php
        include($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/include/footer.php');}
?>