<?php
session_start();
include($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/include/header.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/prof/prof_management.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/pronote_management.php');

// Vérification des accès a la page
if(empty($_COOKIE['user']) || $_COOKIE['poste'] == 'PRO' || $_COOKIE['poste'] == 'ETU') {
    $erreur = new pronote_management();
    $erreur->setMessage('Vous n\'avez pas accès a cette page','index.php');
}else{
// Création d'un objet "Message" de type "pronote_management"
$Message = new pronote_management();
// Execution de la fonction getMessage
$Message->getMessage();
?>

<h1>Liste des profs</h1>
<?php
if(isset($_COOKIE['poste']) && $_COOKIE['poste'] == 'DIR') { ?>

<?php
$prof = new prof_management();
$result=$prof->adminProf(); ?>
<table class="table table-dark">
    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Nom</th>
        <th scope="col">Prenom</th>
        <th scope="col">Email</th>
        <th scope="col">Classe</th>
        <th scope="col">Matiere</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach($result as $row) { ?>
        <tr>
            <th scope="row"><?php echo $row['id_utilisateur']?></th>
            <td><?php echo $row['nom']?></td>
            <td><?php echo $row['prenom']?></td>
            <td><?php echo $row['email']?></td>
            <td><?php $result2=$prof->convertClasse($row['classe']); echo $result2;?></td>
            <td><?php $result2=$prof->convertMatiere($row['id_matiere']); echo $result2;?></td>
            <td><a href="/pronote/vue/absence/absence_prof.php?id_pro=<?php echo $row['id_utilisateur']; ?>" class="card-link">Absent</a></td>
            <td><a href="/pronote/vue/retard/retard.php?id_pro=<?php echo $row['id_utilisateur']; ?>" class="card-link">Retard</a></td>
            <td><a href="/pronote/vue/prof/modifier-prof.php?id_pro=<?php echo $row['id_utilisateur']; ?>" class="card-link">Modifier</a></td>
            <td><a href="/pronote/traitement/supprimer-user.php?id_user=<?php echo $row['id_utilisateur']; ?>" class="card-link">Supprimer</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php } include($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/include/footer.php');}
?>
