<?php

// recherche séquentielle du collectionneur par le nom
function get_collector_by_name($collector_name) {
    $collector_id = NULL;
    $i = 1;

    $file_content = file_get_contents($GLOBALS["prefix_path"]."collector_data.json");
    $json_data = json_decode($file_content, true);

    while($collector_id == NULL && $i <= sizeof($json_data)) {
        if($collector_name == $json_data[$i]['collector_name'])
            $collector_id = $i;
        $i++;
    }

    return $collector_id;
}

/**
 * Récupérer la liste de pokémon avec leur nombre d'apparition dans la liste 
 * sous forme d'une liste de donnée => nom, id, quantité.
 * @param $collector_id l'id du collectionneur
 */
function get_collector_pokemon_list($collector_id) {
    $datas = list_all_pokemon_from_collector($collector_id);
    $pokemons = []; // notre résultat

    foreach($datas as $data) {
        $pokemon_id = $data['pokemon_id'];
        $association_id = $data['association_id'];
        $pokemon = get_pokemon_by_id($pokemon_id);
        $pokemon_name = $data['pokemon_nickname'] == "" 
            ? $pokemon['identifier']
            : $data['pokemon_nickname'];

        if(isset($pokemons[$pokemon_name])) {
            array_push($pokemons[$pokemon_name]['associations'], $association_id);
        } else {
            $pokemons[$pokemon_name] = array(
                "name" => $pokemon_name,
                "id" => $pokemon_id,
                "associations" => [$association_id]
            );
        }
    }

    return $pokemons;
}

?>