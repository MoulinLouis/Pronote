<?php
// Debut de la session
session_start();
// Inclusion du "Header" et de la classe "pronote_management.php"
include($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/include/header.php');
include($_SERVER["DOCUMENT_ROOT"].'/pronote/APP/pronote_management.php');

// Création d'un objet "Message" de type "pronote_management"
$Message = new pronote_management();
// Execution de la fonction getMessage
$Message->getMessage();
?>

<?php
if (isset($_COOKIE['poste'] ) && $_COOKIE['poste'] == 'ETU') { ?>
        <div class="container">
            <div style="padding-top:80px;">
                <h2>Pronote pour Etudiant</h2></br>
                <p>Ce site vous permet de pouvoir voir vos informations et autres</p>
                <p>Votre espace rien qu'a vous pour travailler</ava></p>
            </div>
        </div>
        <?php
    } if (isset($_COOKIE['poste'] ) && $_COOKIE['poste'] == 'PRO') { ?>
        <div class="container">
            <div style="padding-top:80px;">
                <h2>Pronote pour Professeurs</h2></br>
                <p>Ce site vous permet de pouvoir voir vos informations et autres</p>
                <p>Votre espace rien qu'a vous pour travailler</ava></p>
            </div>
        </div>
        <?php
    } if (isset($_COOKIE['poste'] ) && $_COOKIE['poste'] == 'DIR') { ?>
        <div class="container">
            <div style="padding-top:80px;">
                <h2>Pronote pour Direction</h2></br>
                <p>Ce site vous permet de pouvoir voir vos informations et autres</p>
                <p>Votre espace rien qu'a vous pour travailler</ava></p>
            </div>
        </div>
    <?php
}if(empty($_COOKIE['poste'])){ ?>
    <div class="container">
        <div style="padding-top:80px;">
            <h2>Pronote</h2></br>
            <p>Connectez-vous ou inscrivez-vous pour pouvoir avoir acces a votre espace</p>
            <p>Votre espace rien qu'a vous pour travailler</ava></p>
        </div>
    </div>
<?php } include 'APP/include/footer.php' ?>