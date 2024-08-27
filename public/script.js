document.addEventListener('DOMContentLoaded', () => {
    // Ajouter un écouteur d'événements pour chaque bouton de suppression
    document.querySelectorAll('.delete-creation').forEach(button => {
        button.addEventListener('click', function () {
            const creationId = this.dataset.id;
            if (confirm('Voulez-vous vraiment supprimer cette création ?')) {
                // Envoyer une requête de suppression via fetch
                fetch(`index.php?controller=creation&action=deleteCreation&id=${creationId}`, {
                    method: 'DELETE'
                })
                .then(response => response.json()) // Traiter la réponse JSON
                .then(data => {
                    if (data.success) {
                        // Supprimer l'élément du DOM si la suppression est réussie
                        document.getElementById(`creation-${creationId}`).remove();
                    } else {
                        alert('Erreur lors de la suppression de la création.');
                    }
                })
                .catch(error => console.error('Erreur:', error)); // Gérer les erreurs
            }
        });
    });
});