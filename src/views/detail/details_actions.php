<?php

// on doit activer la session de l'utilisateur sur cette page pour pouvoir le supprimer
session_start();

// si se déconnecte on détruit la session et on redirige vers la page d'accueil
if(isset($_POST) && isset($_POST['deconnexion'])) {
    session_destroy();
    header('Location: ../../../index.php');
    exit();
}

?>