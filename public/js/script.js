const toggle = document.getElementById('toggle');

toggle.addEventListener('click', function() {
    this.classList.toggle('active');
});

function confirmSuppression() {
    return confirm('Êtes-vous sûr de vouloir supprimer ce réalisateur ?');
}