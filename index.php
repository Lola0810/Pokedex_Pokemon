<?php
    require_once('src/ressources/pokemon_api.php');

    session_start();

    if(isset($_SESSION) && isset($_SESSION['collector_id'])) {
        header('Location: src/views/collection/collection.php');
        exit();
    }   

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>

    <link rel="stylesheet" href="src/style/style.css">
    <link rel="stylesheet" href="src/style/index.css">
</head>
<body>
    <header>
        <div id="logo">
            <img src="src/images/logo.png" alt="Logo">
            <h1 id="titre_logo">PokéWorld</h1>
        </div>
    </header>
    
    <main>
        <div class="connexion">
            <img id="profile_picture" src="src/images/profile_picture-min.svg" alt="Image de profile">

            <h1>Bienvenue jeune dresseur !</h1>
            
            <form id="choisir_dresseur" action="src/views/collection/collection.php" method="POST">
                <select id="name_dresseur" name="collector">
                    <option value="">--Choisissez un collectionneur--</option>
                    <?php 
                        $collectors = get_collector_list();
                        foreach($collectors as $collector) {
                            $collector_name = $collector['collector_name'];
                            echo "<option value=\"".$collector_name."\">".$collector_name."</option>";
                        }
                    ?>
                </select>

                <input id="valid" type="submit" name="envoie" value="CONNEXION">
            </form>
        </div>  
    </main>

    <footer>
        <h3>©Lola Navarro BUT1 MMI 2021-2022</h3>
    </footer>
</body>
</html>