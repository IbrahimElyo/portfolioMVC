<h2>Inscription</h2>
<?php if (!empty($erreur)) { echo "<div class='alert alert-danger'>$erreur</div>"; } ?> <!-- Afficher un message d'erreur si nécessaire -->
<?= $registerForm ?? '' ?> <!-- Afficher le formulaire d'inscription -->