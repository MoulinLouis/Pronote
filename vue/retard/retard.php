<?php
session_start();
include($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/include/header.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/pronote_management.php');

// Vérification des accès a la page
if(empty($_COOKIE['user']) || $_COOKIE['poste'] == 'ETU') {
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
            $_SESSION['id_etu'] = $_GET['id_etu'];
        }

        ?>

        <div class="offset-2 col-md-8 col-xs-2">
            <div class="form-area text-center">
                <form id="form-contact" method="POST" action="/pronote/traitement/retard/retard-traitement.php">
                    <br>
                    <h3 style="margin-bottom: 25px; text-align: center;">Formulaire de retard</h3>
                    <div class="form-group">

                        <input type="date" class="form-control" id="date_ret" name="date_ret" value="2019-02-21" min="2019-01-01" max="2019-12-31" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="h_ret" name="h_ret" placeholder="Heure du retard" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="arr_ret" name="arr_ret" placeholder="Heure d'arrivé" required>
                    </div>
                    <button type="submit" id="submit" name="submit" class="btn btn-primary">Mettre le retard</button>
                </form>
                <form>
                    <input class="btn btn-secondary" type="button" value="Retour" onclick="history.go(-1)">
                </form>
            </div>
        </div>
        <?php include($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/include/footer.php');}
?>