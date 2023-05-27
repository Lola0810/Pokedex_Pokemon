const BOUTTON_PLUS = ".qtyplus";
const BOUTTON_MOINS = ".qtyminus";

// mettre à jour la quantité dans la base de donnée
async function updateQuantity(actionType, pokemonId, associations, parent) {
    const formData = new FormData();
    formData.append('action', actionType);
    formData.append('pokemon_id', pokemonId);
    formData.append('associations', JSON.stringify(associations));

    const response = await fetch('collection.php', {
        method: 'POST',
        body: formData
    })
    const { association_id } = await response.json();


    if(actionType === "ajouter")
        addAssociation(associations, association_id, parent);
    else 
        removeAssociation(associations, association_id, parent);

    updateCount(parent.querySelector('.qty'), actionType === "ajouter" ? 1 : -1);
}

function addAssociation(associations, associationId, parent) {
    associations.push(associationId);
    updateAssociation(associations, parent);
}

function removeAssociation(associations, associationId, parent) {
    associations.splice(associations.indexOf(associationId), 1);

    if(associations.length === 0)
        document.getElementById(associationId).remove();
    updateAssociation(associations, parent);
}

function updateAssociation(associations, parent) {
    parent.setAttribute('associations', JSON.stringify(associations));
}

function initButton(selectorName, actionType) {
    document.querySelectorAll(selectorName)
    .forEach(boutton => {
        boutton.onclick = () => {
            const parent = boutton.parentElement;
            const pokemonId = parent.id;
            const associations = JSON.parse(parent.getAttribute('associations'));
            updateQuantity(actionType, pokemonId, associations, parent);
        }
    });    
}

// mettre à jour la quantité une fois ajoutée/retirée
function updateCount(htmlInput, count) {
    let value = htmlInput.value;   
    value = parseInt(value)+count;
    if(value <= 0)
        return
    htmlInput.value = value;
}

// initialisation du boutton moins
initButton(`.pokemon__details ${BOUTTON_MOINS}`, 'retirer');

// initialisation du boutton plus
initButton(`.pokemon__details ${BOUTTON_PLUS}`, 'ajouter');


// initialisation des bouttons pour ajouter/retirer de la quantité 
// dans la section d'ajout du pokemon
const qtyInput = document.querySelector('#addition_pokemon .qty')
document.querySelector(`#addition_pokemon ${BOUTTON_MOINS}`)
    .onclick = (e) => updateCount(qtyInput, -1)
document.querySelector(`#addition_pokemon ${BOUTTON_PLUS}`)
    .onclick = (e) => updateCount(qtyInput, 1)