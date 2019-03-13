<?php
session_start();
include($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/include/header.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/cours/cours_management.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/cours/cours.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/pronote_management.php');

// Création d'un objet "Message" de type "pronote_management"
$Message = new pronote_management();
// Execution de la fonction getMessage
$Message->getMessage();

if($_COOKIE['poste'] == 'PRO') {
    ?>
    <div class="container">
        <h1>Cours</h1>

        <form method="post" action="/pronote/traitement/cours/cours-traitement.php">
            <label>Titre du cours</label>
            <input type="text" class="form-control" id="titrecours" name="titrecours" placeholder="Titre" required>

            <label>Texte</label>
            <input type="text" class="form-control" id="textecours" name="textecours" placeholder="Texte du cours" required>

            <label>Date</label>
            <input type="date" id="start" name="datecours" value="2019-02-17" min="2019-01-01" max="2019-12-31">

            <button type="submit" id="submit" name="submit" class="btn btn-primary">Confirmer</button>
        </form>
    </div>
<?php } if($_COOKIE['poste'] == 'ETU' || $_COOKIE['poste'] == 'PRO') { ?>
<div class="container">
    <h1 style="text-align:center">Liste des cours</h1>
    <div class="card-deck">
        <?php
        $user=new cours([
            'idutilisateur' => $_COOKIE['user']
        ]);
        $cours = new pronote_management();
        $result = $cours->afficherCours($user);
        foreach($result as $row) { ?>
        <div class="col-md-4">
            <div class="card text-white bg-dark mb-3 text-center" >
                <div class="card-header"><?php echo $row['titre']; ?></div>
                <br class="card-body">
                <h5 class="card-title"><?php echo $row['date_cours'];?></h5>
                <div class="btn-group-vertical">
                    <a href="voir-cours.php?id_cours=<?php echo $row['id_cours']; ?>" class="btn btn-primary">Voir le cours</a>
                    <?php if($_COOKIE['poste'] == 'PRO') { ?>
                    <a href="modifier-cours.php?id_cours=<?php echo $row['id_cours']; ?>"class="btn btn-primary">Modifier</a>
                    <a href="/pronote/traitement/cours/supprimercours-traitement.php?id_cours=<?php echo $row['id_cours']; ?>" class="btn btn-primary">Supprimer</a>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php } } ?>
    </div>
</div>
<?php
include($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/include/footer.php');
?>
