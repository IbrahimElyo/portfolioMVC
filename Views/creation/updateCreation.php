<?php
$title = "Mon portfolio - Modification d'une création"; // Définir le titre de la page
?>

<h1>Modification d'une création</h1>
<?php
if(!empty($erreur)){
?>
    <div class="alert alert-danger" role="alert">
        <?=$erreur?> <!-- Afficher le message d'erreur si nécessaire -->
    </div>
<?php } ?>
<section class="row">
    <div class="col-2 align-self-end">
        <img src="<?=$picture?>" alt="titre de la création" class="img-fluid"> <!-- Afficher l'image de la création -->
    </div>
    <div class="col-10"><?=$updateForm?></div> <!-- Afficher le formulaire de mise à jour -->
</section>