
// J'ai essayé de déplacer le script d'acces à l'API ici.
// Malheuresement, comme on doit acceder à l'id avec le template twig, je n'ai pas réussi à faire fonctionner ce script.

function getDetailPathologie() {
    const id = document.getElementById('pathologieContainer').dataset.id;
    const url = "http://localhost:50180/myApi?id=" + id;

    fetch(url)
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            let patho = data;

            document.getElementById('categorie').innerHTML += patho.categorie;
            document.getElementById('meridien').innerHTML += patho.nom_meridien;
            document.getElementById('type').innerHTML += patho.interpretation_type;
            document.getElementById('description').innerHTML += patho.description;
            document.getElementById('symptomes').innerHTML += patho.description_des_symptomes;
        })
        .catch(function(error) {
            console.log(error);
        });
}

document.addEventListener("DOMContentLoaded", getDetailPathologie());
    