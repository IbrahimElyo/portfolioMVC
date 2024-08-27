<h2>Connexion</h2>
<?php if (!empty($erreur)) { echo "<div class='alert alert-danger'>$erreur</div>"; } ?> <!-- Afficher un message d'erreur si nécessaire -->
<?= $loginForm ?? '' ?> <!-- Afficher le formulaire de connexion -->
<div class="mt-3">
    <a href="index.php?controller=auth&action=register" class="btn btn-secondary">Créer un compte</a> <!-- Lien pour créer un compte -->
</div>
