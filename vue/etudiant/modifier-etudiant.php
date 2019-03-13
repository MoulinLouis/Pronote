<?php
session_start();
include($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/include/header.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/etudiant/etudiant_management.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/pronote_management.php');

// Vérification des accès a la page
if(empty($_COOKIE['user']) || $_COOKIE['poste'] == 'PRO' || $_COOKIE['poste'] == 'ETU') {
    $erreur = new pronote_management();
    $erreur->setMessage('Vous n\'avez pas accès a cette page','index.php');
}elseif(empty($_GET['id_etu'])) {
    $erreur = new pronote_management();
    $erreur->setMessage('Vous n\'avez selectionné aucun etudiant','index.php');
}else{
// Création d'un objet "Message" de type "pronote_management"
$Message = new pronote_management();
// Execution de la fonction getMessage
$Message->getMessage();

if(isset($_GET['id_etu'])) {
    $value=new etudiant_management();
    $result = $value->getEtudiant($_GET['id_etu']);
}
?>


<div class="offset-2 col-md-8 col-xs-2">
    <div class="form-area text-center">
        <form id="form-contact" method="POST" action="/pronote/traitement/etudiant/modificationetu-traitement.php">
            <br>
            <h3 style="margin-bottom: 25px; text-align: center;">Modification étudiant</h3>
            <div class="form-group">
                <input type="text" name="nom" class="form-control" value="<?php echo $result['nom']; ?>">
            </div>
            <div class="form-group">
                <input type="text" name="prenom" class="form-control" value="<?php echo $result['prenom']; ?>">
            </div>
            <div class="form-group">
                <input type="text" name="email" class="form-control" value="<?php echo $result['email']; ?>">
            </div>
            <div class="form-group">

                <?php
                $deroul = new pronote_management();
                $classes = $deroul->deroulantClasse();

                $value=new etudiant_management();
                $result = $value->getEtudiant($_GET['id_etu']);

                ?>

                <select class=form-control name="classe">
                    <?php
                     foreach($classes as $classe) { ?>
                <option value="<?php echo $classe['id_classe']; ?>" name="classe"<?php
                if($classe['id_classe'] == $result['classe']) {
                    echo 'selected';
                }
                ?>><?php echo $classe['nom_classe']; ?></option>
                <?php } ?>
                </select>
                <input type="hidden" name="id_etu" value="<?php echo $_GET['id_etu']?>">
            </div>

            <button type="submit" id="submit" name="submit" class="btn btn-primary">Modifier</button>
        </form>
        <form>
            <input class="btn btn-secondary" type="button" value="Retour" onclick="history.go(-1)">
        </form>
    </div>
</div>
<?php include ($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/include/footer.php');}
?>