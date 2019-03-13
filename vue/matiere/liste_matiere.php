<?php
session_start();
include($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/include/header.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/matiere/matiere_management.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/pronote_management.php');

// Vérification des accès a la page
if(empty($_COOKIE['user']) || $_COOKIE['poste'] == 'PROF' || $_COOKIE['poste'] == 'ETU') {
    $erreur = new pronote_management();
    $erreur->setMessage('Vous n\'avez pas accès a cette page','index.php');
}else{
// Création d'un objet "Message" de type "pronote_management"
$Message = new pronote_management();
// Execution de la fonction getMessage
$Message->getMessage();
?>

<h1>Liste des matières</h1>
<?php
if(isset($_COOKIE['poste']) && $_COOKIE['poste'] == 'DIR') { ?>

    <?php
    $matiere = new matiere_management();
    $result = $matiere->afficherMatiere(); ?>
    <table class="table table-dark">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nom de la matière</th>
            <th scope="col">Modifier</th>
            <th scope="col">Supprimer</th>

        </tr>
        </thead>
        <tbody>
        <?php
        foreach($result as $row) { ?>
            <tr>
                <td><?php echo $row['id_matiere']?></td>
                <td><?php echo $row['nom_matiere']?></td>
                <td><a href="/pronote/vue/matiere/modifier_matiere.php?id_matiere=<?php echo $row['id_matiere']?>" class="card-link">Modifier</a></td>
                <td><a href="/pronote/traitement/matiere/supprimermatiere-traitement.php?id_matiere=<?php echo $row['id_matiere']?>" class="card-link">Supprimer</a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php }
include($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/include/footer.php');}
?>

