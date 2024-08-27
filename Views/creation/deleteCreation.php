<?php $title = "Supprimer la création"; // Définir le titre de la page ?>
<h2>Supprimer la création</h2>
<p>Êtes-vous sûr de vouloir supprimer cette création ?</p>
<p><strong>Titre :</strong> <?= htmlspecialchars($creation->title) // Afficher le titre de la création ?></p>
<p><strong>Description :</strong> <?= htmlspecialchars($creation->description) // Afficher la description de la création ?></p>

<form method="POST" action="">
    <input type="hidden" name="confirm" value="yes"> <!-- Champ caché pour confirmer la suppression -->
    <button type="submit" class="btn btn-danger">Oui, supprimer</button> <!-- Bouton pour confirmer la suppression -->
    <a href="index.php?controller=creation&action=index" class="btn btn-secondary">Annuler</a> <!-- Lien pour annuler la suppression -->
</form>