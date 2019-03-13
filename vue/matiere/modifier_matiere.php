<?php
session_start();
include($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/include/header.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/matiere/matiere_management.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/pronote_management.php');

// Vérification des accès a la page
if(empty($_COOKIE['user']) || $_COOKIE['poste'] == 'PRO' || $_COOKIE['poste'] == 'ETU') {
    $erreur = new pronote_management();
    $erreur->setMessage('Vous n\'avez pas accès a cette page','index.php');
}elseif(empty($_GET['id_matiere'])) {
    $erreur = new pronote_management();
    $erreur->setMessage('Vous n\'avez selectionné aucune matiere','index.php');
}else{
// Création d'un objet "Message" de type "pronote_management"
        $Message = new pronote_management();
// Execution de la fonction getMessage
        $Message->getMessage();

        if($_GET) {
            $value=new matiere_management();
            $result = $value->getMatiere($_GET['id_matiere']);

        }
        ?>

        <div class="offset-2 col-md-8 col-xs-2">
            <div class="form-area text-center">
                <form id="form-contact" method="POST" action="/pronote/traitement/matiere/modifiermatiere-traitement.php">
                    <br>
                    <h3 style="margin-bottom: 25px; text-align: center;">Modification de matière</h3>
                    <div class="form-group">
                        <input type="text" name="nom_matiere" class="form-control" value="<?php echo $result['nom_matiere']; ?>">
                    </div>
                    <input type="hidden" name="id_matiere" value="<?php echo $_GET['id_matiere']?>">
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