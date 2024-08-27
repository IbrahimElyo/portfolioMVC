<?php
$title = "Mon portfolio - " . $creation->title; // Définir le titre de la page
?>
<article class="row justify-content-center text-center">
    <h1 class="col-12"><?= $creation->title ?></h1> <!-- Afficher le titre de la création -->
    <p>Date de publication : <?= $creation->created_at ?></p> <!-- Afficher la date de publication -->
    <img src="<?= $creation->picture ?>" alt="<?= $creation->title ?>" class="col-4"> <!-- Afficher l'image de la création -->
    <p><?= $creation->description ?></p> <!-- Afficher la description de la création -->
</article>
