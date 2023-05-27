<?php

    require_once('../../ressources/pokemon_api.php');
    require_once('details_actions.php');

    $pokemon_id = $_GET['pokemon_id'];

    // si il ne renseigne pas l'id du pokemon ou alors que pokemon_id n'est pas renseigné dans l'url alors on le renvoie sur le home
    if((!isset($_GET) || !array_key_exists("pokemon_id", $_GET)) || empty($pokemon_id)) {
        header('Location: ../../../index.php');
        exit();
    }

    $pokemon = get_pokemon_by_id($pokemon_id); // on récupère les données du pokemon

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détail</title>

    <link rel="stylesheet" href="../../style/style.css">
    <link rel="stylesheet" href="../../style/detail.css">
</head>
<body>
    <header>
        <div id="logo">
            <img src="../../images/logo.png" alt="Logo">
            <h1 id="titre_logo">PokéWorld</h1>
        </div>

        <a id="retour" href="../collection/collection.php"><button>RETOUR</button></a>
        <form method="POST" action="#">
            <input type="submit" id="deconnexion" name="deconnexion" value="DECONNEXION">
        </form>
    </header>

    <main>
        
        <div class="container_detail">
            <h1><?php echo $pokemon['identifier'] ?></h1>
            
            <div id="info_pokemon">
                <img src="../../images/pokemon_img/full/<?php echo $pokemon_id ?>.png" alt="Bulbizar">
            
                <div id="valeurs">
                    <h3>
                        Type

                        <?php
                            
                            $types = preg_split('/(\s+)\/\1/', $pokemon['type']);
                            foreach($types as $type) {
                                echo "<span class=\"types ".strtolower($type)."\">".$type."</span>";
                            }

                        ?>
                    </h3>
                    <h3>
                        Taille 
                        <span><?php echo $pokemon['height'] ?> decimètre</span>
                    </h3>
                    <h3>
                        Poids 
                        <span><?php echo $pokemon['weight'] ?> livres</span>
                    </h3>
                    <h3>
                        Experience de base
                        <span><?php echo $pokemon['base_experience'] ?> exp</span>
                    </h3>
                </div>
            </div>
         
            <!--<div id="other_info">
                <form id="modifier_nom" method="POST">
                    <label for="name_pokemon">Modifer le nom du pokemon</label>
                    <input type="text" id="name_pokemon" name="pokemon">
                    <input type="submit" value="VALIDER">
                </form>
            </div>-->
            
        </div>

    </main>

    <footer>
        <h3>©Lola Navarro BUT1 MMI 2021-2022</h3>
    </footer>
</body>
</html>