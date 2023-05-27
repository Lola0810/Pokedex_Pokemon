<?php

$INDEX_PAGE = "../../../index.php";

// on revient sur la session de l'utilisateur avec session start
session_start();

if(isset($_POST) && isset($_POST['action']) && isset($_POST['pokemon_id'])) {
    $associations = json_decode($_POST['associations']);
    switch($_POST['action']) {
        case 'ajouter':
            $associationId = add_pokemon_to_collector($_SESSION['collector_id'], $_POST['pokemon_id']);
            break;
        case 'retirer':
            $associationId = delete_pokemon_from_collector(end($associations));
            break;
    }

    echo json_encode(array(
        "association_id" => $associationId
    ));

    exit();
}

// si se déconnecte on détruit la session et on redirige vers la page d'accueil
if(isset($_POST) && isset($_POST['deconnexion'])) {
    session_destroy();
    header('Location: '.$INDEX_PAGE);
    exit();
}

// vérification du formulaire précédent.
if(isset($_POST) && isset($_POST['envoie'])) {
    $utilisateur = $_POST['collector']; // nom du collectionneur
    if(empty($utilisateur) || !isset($utilisateur)) {
        header('Location: '.$INDEX_PAGE);
        exit();
    }
    $collector_id = get_collector_by_name($utilisateur);

    if($collector_id == NULL) {
        header('Location: '.$INDEX_PAGE); // si l'utilisateur n'est pas trouvé on le renvoie sur la page d'accueil
        exit();
    }

    $_SESSION['collector_id'] = $collector_id;
    $_SESSION['collector_name'] = $utilisateur;
}


// on redirige l'utilisateur vers la page d'accueil si il n'est pas connecté
if(!isset($_SESSION) || !isset($_SESSION["collector_id"])) {
    header('Location: '.$INDEX_PAGE);
    exit();
}

// ajouter un pokemon
if(isset($_POST) && isset($_POST['ajouter'])) {
    $pokemon_id = $_POST['pokemon']; // nom du pokemon
    // on vérifie que le pokemon est bien renseigné
    if(!empty($pokemon_id) || !isset($pokemon_id)) {
        $quantity = $_POST['quantity']; // récupérer le nombre de pokemon
        for($i = 0;$i < $quantity;$i++) // on ajout le nombre de pokemon par rapport à la quantité demandée 
            add_pokemon_to_collector($_SESSION['collector_id'], $pokemon_id);   
    }

}


?>