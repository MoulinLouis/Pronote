<?php
session_start();
include($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/include/header.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/cours/cours_management.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/pronote_management.php');

// Vérification des accès a la page
if(empty($_COOKIE['user']) || $_COOKIE['poste'] == 'ETU') {
    $erreur = new pronote_management();
    $erreur->setMessage('Vous n\'avez pas accès a cette page','index.php');
}else{
// Création d'un objet "Message" de type "pronote_management"
$Message = new pronote_management();
// Execution de la fonction getMessage
$Message->getMessage();

if(isset($_GET['id_cours'])) {
    $value=new cours_management();
    $result = $value->getCours($_GET['id_cours']);
}
?>

<div class="offset-2 col-md-8 col-xs-2">
    <div class="form-area text-center">
        <form id="form-contact" method="POST" action="/pronote/traitement/cours/modificationcours-traitement.php">
            <br>
            <h3 style="margin-bottom: 25px; text-align: center;">Modification étudiant</h3>
            <div class="form-group">
                <input type="text" name="titre" class="form-control" value="<?php echo $result['titre']; ?>">
            </div>
            <div class="form-group">
                <input type="text" name="texte" class="form-control" value="<?php echo $result['texte']; ?>">
            </div>
            <div class="form-group">
                <input type="text" name="date_cours" class="form-control" value="<?php echo $result['date_cours']; ?>">
            </div>
            <input type="hidden" name="id_cours" value="<?php echo $_GET['id_cours']?>">
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