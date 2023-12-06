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

// Sélectionne le formulaire et écoute l'événement de soumission
document.querySelector('.fill-correctly').addEventListener('submit', function(event) {
    // Récupère la valeur du champ 'nom'
    var inputValue = document.getElementById('nom').value;

    // Expression régulière pour les caractères spéciaux
    var specialChars = /[<>(){}!\/%&§]/; 
    
    // Récupère les valeurs des champs 'acteur' et 'film'
    var acteurValue = document.getElementById('acteur').value;
    var filmValue = document.getElementById('film').value;
    
    // Vérifie la présence de caractères spéciaux dans 'inputValue'
    var specialCharsDetected = specialChars.test(inputValue);

    // Vérifie si aucun acteur et aucun film n'est sélectionné
    var acteurNotSelected = acteurValue === ""; 
    var filmNotSelected = filmValue === ""; 

    // Message de confirmation initial
    var confirmationMessage = "Effectuer les modifications requises :\n";
    
    // Supprimer toutes les classes 'champ-a-corriger' existantes avant de vérifier les erreurs
    var fields = document.querySelectorAll('.champ-a-corriger');
    fields.forEach(function(field) {
        field.classList.remove('champ-a-corriger');
    });
    
    // Vérifie s'il y a des caractères spéciaux dans 'inputValue'
    if (specialCharsDetected) {
        confirmationMessage += "\n- Veuillez éviter d'utiliser des caractères spéciaux.\n";
    }

    // Vérifie si 'inputValue' est vide
    if (inputValue === "") {
        confirmationMessage += "\n- Champ obligatoire. Veuillez saisir un rôle.\n";
    }
    
    // Vérifie si l'acteur ou le film n'est pas sélectionné
    if (acteurNotSelected || filmNotSelected) {
        confirmationMessage += (acteurNotSelected ? "- Veuillez sélectionner un acteur pour ce rôle.\n" : "");
        confirmationMessage += (filmNotSelected ? "- Veuillez sélectionner un film pour ce rôle.\n" : "");
    }
    
    // Ajout de la classe pour le style visuel rouge
    document.getElementById('nom').classList.add('champ-a-corriger');
    // Sélection des champs à corriger
    var acteurField = document.getElementById('acteur');
    var filmField = document.getElementById('film');
    
    // Si des erreurs sont détectées, affiche le message de confirmation dans une alerte
    if (specialCharsDetected || inputValue === "" || acteurNotSelected || filmNotSelected) {
        if (specialCharsDetected) {
            document.getElementById('nom').classList.add('champ-a-corriger');
        }
        if (inputValue === "") {
            document.getElementById('nom').classList.add('champ-a-corriger');
        }
        if (acteurNotSelected || filmNotSelected) {
            if (acteurNotSelected) {
                document.getElementById('acteur').classList.add('champ-a-corriger');
            }
            if (filmNotSelected) {
                document.getElementById('film').classList.add('champ-a-corriger');
            }
        }

        // Affiche une alerte avec les messages d'erreur
        alert(confirmationMessage);
         
        // Empêche la soumission du formulaire
        event.preventDefault(); 
    } else {
        // Si aucun caractère spécial n'est détecté et que les champs sont sélectionnés, le formulaire peut être soumis normalement

        // Retire la classe de style visuel si précédemment ajoutée
        document.getElementById('nom').classList.remove('champ-a-corriger');
        // Retire la classe de style visuel si précédemment ajoutée
        acteurField.classList.remove('champ-a-corriger');
        filmField.classList.remove('champ-a-corriger');
    }
});