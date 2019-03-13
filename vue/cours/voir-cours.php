<?php
session_start();
include($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/include/header.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/cours/cours_management.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/cours/cours.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/pronote_management.php');

// Vérification des accès a la page
if(empty($_COOKIE['user'])) {
    $erreur = new pronote_management();
    $erreur->setMessage('Vous n\'avez pas accès a cette page','index.php');
}else{
// Création d'un objet "Message" de type "pronote_management"
$Message = new pronote_management();
// Execution de la fonction getMessage
$Message->getMessage();

if(empty($_COOKIE['user']) && empty($_COOKIE['poste'])) {
    $_SESSION['message'] = 'Vous nêtes pas connecté';
    header('location: index.php');
}
if($_GET) {
$value=new cours_management();
$result = $value->getCours($_GET['id_cours']);

if(isset($_GET['id_cours'])) {
    $_SESSION['id_cours'] = $_GET['id_cours'];
}
?>
    <div class="container" style="padding-top:50px;">
    <div class="card">
        <div class="card-header">
            <?php echo $result['date_cours']; ?>
        </div>
        <div class="card-body">
            <h5 class="card-title"><?php echo $result['titre']; ?></h5>
            <p class="card-text"><?php echo $result['texte']; ?></p>
            <form>
                <input class="btn btn-secondary" type="button" value="Retour" onclick="history.go(-1)">
            </form>
        </div>
    </div>
    </div>
<?php }
include($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/include/footer.php');}
?>
