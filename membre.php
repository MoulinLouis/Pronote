<?php
session_start();
include($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/include/header.php');
include($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/absence/absence_management.php');
include($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/retard/retard_management.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/pronote_management.php');

require_once('app/etudiant/etudiant_management.php');
require_once('app/prof/prof_management.php');
require_once('app/direction/direction_management.php');

// Création d'un objet "Message" de type "pronote_management"
$Message = new pronote_management();
// Execution de la fonction getMessage
$Message->getMessage();
?>
<?php
// Vérification des accès a la page
if(empty($_COOKIE['user'])) {
    $erreur = new pronote_management();
    $erreur->setMessage('Vous n\'avez pas accès a cette page','index.php');
}else{
    $retard = new retard_management();
    $result_retard = $retard->afficherRetard();
    $absence = new absence_management();
    $result_absence = $absence->afficherAbsence();
?>
<?php
if($_COOKIE['poste'] == 'ETU') {
    $membre = new etudiant_management();
    $result = $membre->membreEtudiant();

    ?>
    <div class="container">
        <div></br>
            <h1 class="offset-4">Espace membre</h1>
            <div class="card text-white bg-dark offset-4 text-center" style="max-width: 18rem;">
                <div class="card-header"><i class="fas fa-user"></i><?php echo "".$result['nom'].' '; echo $result['prenom'];?></div>
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-envelope"></i><?php echo " ".$result['email'];?></h5>
                    <p class="card-text"><i class="fas fa-layer-group"></i></i><?php $result2=$membre->convertClasse($result['classe']); echo " ".$result2;?></p>
                </div>
            </div>
        </div></br>
    <div class="card text-white bg-danger offset-4 text-center" style="max-width: 18rem;">
        <div class="card-header">Retard / Absence</div>
            <div class="card-body">
                <h5 class="card-title">Absence</h5>
                <?php
                if($result_absence) {
                foreach($result_absence as $row_absence) { ?>
                     <p class="card-text">Absent le <?php echo $row_absence['date_abs']; ?></p>
                <?php } } else { ?>
                <p class="card-text">Aucune absence</p>
                <?php } ?>
                    <h5 class="card-title">Retard</h5>
                <?php
                if($result_retard){
                foreach($result_retard as $row_retard) { ?>
                     <p class="card-text">Retard de <?php echo $row_retard['h_ret']; ?> à <?php echo $row_retard['arr_ret'];?> le <?php echo $row_retard['date_ret']; ?></p>
                <?php }} else { ?>
                <p class="card-text">Aucun retard</p>
                    <?php } ?>
            </div>
        </div>
    </div>
    <?php
} elseif($_COOKIE['poste'] == 'PRO') {
    $membre = new prof_management();
    $result = $membre->membreProf();
    ?>
    <div class="container">
        <div ></br>
            <h1 class="offset-4">Espace membre</h1>
            <div class="card text-white bg-dark offset-4 text-center" style="max-width: 18rem;">
                <div class="card-header"><i class="fas fa-user"></i><?php echo "".$result['nom'].' '; echo $result['prenom'];?></div>
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-envelope"></i><?php echo " ".$result['email'];?></h5>
                    <p class="card-text"><i class="fas fa-layer-group"></i></i><?php $result2=$membre->convertClasse($result['classe']); echo " ".$result2;?></p>
                </div>
            </div>
        </div></br>
        <div class="card text-white bg-danger offset-4 text-center" style="max-width: 18rem;">
            <div class="card-header">Retard / Absence</div>
            <div class="card-body">
                <h5 class="card-title">Absence</h5>
                <?php
                if($result_absence) {
                    foreach($result_absence as $row_absence) { ?>
                        <p class="card-text">Absent le <?php echo $row_absence['date_abs']; ?></p>
                    <?php } } else { ?>
                    <p class="card-text">Aucune absence</p>
                <?php } ?>
                <h5 class="card-title">Retard</h5>
                <?php
                if($result_retard){
                    foreach($result_retard as $row_retard) { ?>
                        <p class="card-text">En retard le <?php echo $row_retard['date_ret']; ?></p>
                    <?php }} else { ?>
                    <p class="card-text">Aucun retard</p>
                <?php } ?>
            </div>
        </div>
    </div>

    <?php
} elseif($_COOKIE['poste'] == 'DIR') {
    $membre = new direction_management();
    $result = $membre->membreDirection();
    ?>
    <div class="container">
        <div class="offset-4"><br>
            <h1 class="center">Espace membre</h1>
            <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                <div class="card-header"><i class="fas fa-user"></i><?php echo " ".$result['nom'].' '; echo $result['prenom'];?></div>
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-envelope"></i><?php echo " ".$result['email'];?></h5>
            </div>
        </div>
        </div>
    </div>
<?php } include 'APP/include/footer.php'; }?>