<?php

require_once('../../ressources/pokemon_api.php');
require_once('collection_utils.php');
require_once('collection_action.php');

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Collection</title>

    <link rel="stylesheet" href="../../style/style.css">
    <link rel="stylesheet" href="../../style/collection.css">
</head>
<body>
    <header>
        <div id="logo">
            <img src="../../images/logo.png" alt="Logo">
            <h1 id="titre_logo">PokéWorld</h1>
        </div>

        <form method="POST" action="#">
            <input id="deconnexion" type="submit" name="deconnexion" value="DECONNEXION">
        </form>
    </header>
    
    <main id="main_collection">
        <div class="container_collection">
            <h1>Bienvenue dans votre collection, <?php echo $_SESSION['collector_name'] ?>.</h1>

            <form id="addition_pokemon" method="POST" action="#">
                <label for="name_pokemon">Quel pokemon voulez-vous ajouter ?
                    <select name="pokemon" id="name_pokemon">
                        <option value="">--Choisissez un pokemon--</option>
                        <?php 
                            $pokemons = list_all_pokemon();
                            foreach($pokemons as $pokemon_id => $pokemon) {
                                $pokemon_name = $pokemon["identifier"];
                                echo "<option value=".$pokemon_id.">".$pokemon_name."</option>";
                            }
                        ?>
                            
                    </select>
                </label>
                    <input type='button' value='-' class='qtyminus' field='quantity'/>
                    <input type='text' name='quantity' value='1' class='qty' />
                    <input type='button' value='+' class='qtyplus' field='quantity' />
                <input type="submit" name="ajouter" value="AJOUTER"/>
            </form>
            
            <div class="container_liste">
                <?php
                    $pokemons = get_collector_pokemon_list($_SESSION['collector_id']);
                    
                    foreach($pokemons as $pokemon) {
                        $pokemon_name = $pokemon['name'];
                        $pokemon_id = $pokemon['id'];
                        $associations = $pokemon['associations'];

                        echo "
                            <div class=\"pokemon__details\" id=\"".$associations[0]."\">
                                <img src=\"../../images/pokemon_img/96px/".$pokemon_id.".png\" alt=\"".$pokemon_name."\">
                                <h3>".$pokemon_name."</h3>
            
                                <a href=\"../detail/detail.php?pokemon_id=".$pokemon_id."\">
                                    <button>DETAIL</button>
                                </a> 
                                <div associations='".json_encode($associations)."' id=".$pokemon_id." class=\"quantity\">
                                    <input type='button' value='-' class='qtyminus' />
                                    <input type='text' name='quantity' value='".count($associations)."' class='qty' disabled />
                                    <input type='button' value='+' class='qtyplus' />
                                </div>  
                            </div>
                        ";
                    }
                ?>
            </div>  
        </div> 
    </main>

    <footer>
        <h3>©Lola Navarro BUT1 MMI 2021-2022</h3>
    </footer>

    <script src="collection_action.js"></script>

</body>
</html>