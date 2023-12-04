const toggle = document.getElementById('toggle');

// si toggle existe dans le DOM
if (toggle) {
    toggle.addEventListener('click', function() {
        this.classList.toggle('active');
    });
}

// Sélectionnez tous les éléments avec la classe 'delete-something'
const deleteSomethingElts = document.querySelectorAll('.delete-something');

deleteSomethingElts.forEach(deleteSomethingElt =>
    deleteSomethingElt.addEventListener("click", function(event) {
        event.preventDefault();

        if (confirm("Confirmez-vous cette suppression ?")) {
            window.location.href = deleteSomethingElt.getAttribute("href");
        }
    })
);