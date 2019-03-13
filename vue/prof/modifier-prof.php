<?php
session_start();
include($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/include/header.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/pronote_management.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/prof/prof_management.php');

// Vérification des accès a la page
if(empty($_COOKIE['user']) || $_COOKIE['poste'] == 'PRO' || $_COOKIE['poste'] == 'ETU') {
    $erreur = new pronote_management();
    $erreur->setMessage('Vous n\'avez pas accès a cette page','index.php');
}elseif(empty($_GET['id_pro'])) {
    $erreur = new pronote_management();
    $erreur->setMessage('Vous n\'avez selectionné aucun prof','index.php');
}else{
// Création d'un objet "Message" de type "pronote_management"
$Message = new pronote_management();
// Execution de la fonction getMessage
$Message->getMessage();

if($_GET) {
    $value=new prof_management();
    $result = $value->getProf($_GET['id_pro']);

}
?>


<div class="offset-2 col-md-8 col-xs-2">
    <div class="form-area text-center">
        <form id="form-contact" method="POST" action="/pronote/traitement/prof/modificationpro-traitement.php">
            <br>
            <h3 style="margin-bottom: 25px; text-align: center;">Modification professeur</h3>
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

                $value=new prof_management();
                $result = $value->getProf($_GET['id_pro']);

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
            </div>
            <div class="form-group">

                <?php
                $deroul = new pronote_management();
                $matieres = $deroul->deroulantMatiere();

                $value=new prof_management();
                $result = $value->getProf($_GET['id_pro']);
                ?>

                <select class=form-control name="matiere">
                    <?php
                    foreach($matieres as $matiere) { ?>
                        <option value="<?php echo $matiere['id_matiere']; ?>" name="matiere"<?php
                        if($matiere['id_matiere'] == $result['id_matiere']) {
                            echo 'selected';
                        }
                        ?>><?php echo $matiere['nom_matiere']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <input type="hidden" name="id_pro" value="<?php echo $_GET['id_pro']?>">
            <button type="submit" id="submit" name="submit" class="btn btn-primary">Modifier</button>
        </form>
        <form>
            <input class="btn btn-secondary" type="button" value="Retour" onclick="history.go(-1)">
        </form>
    </div>
</div>
<?php include($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/include/footer.php');}
?>