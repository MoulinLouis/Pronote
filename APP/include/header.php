<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css" integrity="sha384-PDle/QlgIONtM1aqA2Qemk5gPOE7wFq8+Em+G/hmo5Iq0CCmYZLv3fVRDJ4MMwEA" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js" integrity="sha384-7aThvCh9TypR7fIc2HV4O/nFMVCBwyIUKL8XCtKE+8xgCgl/PQGuFsvShjr74PBp" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/pronote/index.php"> <img class="logo" src="/pronote/images/logopronote.png" height="30"> Pronote</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar1" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbar1">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/pronote/index.php">Accueil<span class="sr-only">(current)</span></a>
            </li>

            <?php if(isset($_COOKIE['poste']) && $_COOKIE['poste'] == 'ETU') { ?>
                <li class="nav-item"><a class="nav-link" href="/pronote/membre.php">Espace membre</a></li>
                <li class="nav-item"><a class="nav-link" href="/pronote/vue/cours/cours.php">Cours</a></li>

            <?php } if(isset($_COOKIE['poste']) && $_COOKIE['poste'] == 'PRO') { ?>
                <li class="nav-item"><a class="nav-link" href="/pronote/membre.php">Espace membre</a></li>
                <li class="nav-item"><a class="nav-link" href="/pronote/vue/cours/cours.php">Cours</a></li>
                <li class="nav-item"><a class="nav-link" href="/pronote/vue/etudiant/liste_etudiant.php">Liste étudiant</a></li>

            <?php } if(isset($_COOKIE['poste']) && $_COOKIE['poste'] == 'DIR') { ?>
                <li class="nav-item"><a class="nav-link" href="/pronote/membre.php">Espace membre</a></li>
                <div class="dropdown">
                    <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown">
                        Etudiant
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/pronote/vue/etudiant/liste_etudiant.php">Afficher</a>
                        <a class="dropdown-item" href="/pronote/vue/etudiant/ajout_etudiant.php">Ajouter</a>
                    </div>
                </div>
                <div class="dropdown">
                    <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown">
                        Professeur
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/pronote/vue/prof/liste_prof.php">Afficher</a>
                        <a class="dropdown-item" href="/pronote/vue/prof/ajout_prof.php">Ajouter</a>
                    </div>
                </div>
                <div class="dropdown">
                    <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown">
                        Direction
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/pronote/vue/direction/liste_direction.php">Afficher</a>
                        <a class="dropdown-item" href="/pronote/vue/direction/ajout_direction.php">Ajouter</a>
                    </div>
                </div>
                <div class="dropdown">
                    <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown">
                        Matière
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/pronote/vue/matiere/liste_matiere.php">Afficher</a>
                        <a class="dropdown-item" href="/pronote/vue/matiere/ajout_matiere.php">Ajouter</a>
                    </div>
                </div>
                <div class="dropdown">
                    <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown">
                        Classe
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/pronote/vue/classe/liste_classe.php">Afficher</a>
                        <a class="dropdown-item" href="/pronote/vue/classe/ajout_classe.php">Ajouter</a>
                    </div>
                </div>
            <?php } if(empty($_COOKIE['user'])) { ?>
                <a class="btn ml-2 btn-warning" href="/pronote/connexion.php">Se connecter</a>
                <a class="btn ml-2 btn-warning" href="/pronote/inscription.php">S'inscrire</a>
            <?php } else { ?>
            <a class="btn ml-2 btn-warning" href="/pronote/traitement/deconnexion-traitement.php">Déconnexion</a>
        </ul>
    </div>

    <?php } ?>
</nav>

</html>