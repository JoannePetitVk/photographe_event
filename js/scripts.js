//MODAL
// Sélectionne la modale
const modal = document.querySelector('.modal-container');

// Sélectionne le bouton qui ouvre la modale
const btn = document.querySelector('.myModal');

// Sélectionne la zone d'overlay (qui est cliquée pour fermer)
const overlay = document.querySelector('.modal-overlay');

// Quand l'utilisateur clique sur le bouton, la modale s'ouvre
btn.onclick = function () {
    console.log("Bouton cliqué, ouverture modal");
    modal.classList.remove('modal-hide');
    modal.classList.add('modal-show');
    console.log(modal.classList); // Vérifie les classes après l'ouverture
};

// Quand l'utilisateur clique sur l'overlay en dehors du formulaire, la modale se ferme
overlay.onclick = function (event) {
    console.log("Overlay clicked");
    if (event.target === overlay) {
        console.log("Closing modal");
        modal.classList.remove('modal-show');
        modal.classList.add('modal-hide');
    }
};

// Optionnel : Fermer la modale quand l'utilisateur clique sur "Envoyer"
document.querySelector('form').addEventListener('submit', function (event) {
    event.preventDefault(); // Empêche le comportement par défaut
    console.log("Form submitted, closing modal");
    modal.classList.remove('modal-show');
    modal.classList.add('modal-hide');
    // Optionnel : Ajoute ici la logique pour envoyer le formulaire
});

document.querySelector('a[aria-current="page"]').addEventListener('click', function (event) {
    event.preventDefault(); // Empêche le clic de rediriger
});


