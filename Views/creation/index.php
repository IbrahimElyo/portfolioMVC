<?php $title = "Mon portfolio - liste de mes créations"; // Définir le titre de la page ?>
<h2>Liste de mes créations</h2>
<a href="index.php?controller=creation&action=add"><button type="button" class="btn btn-primary">Ajouter une création</button></a> <!-- Bouton pour ajouter une création -->
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">description</th>
            <th scope="col">created_at</th>
            <th scope="col">picture</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($list as $value){
                echo "<tr id='creation-" . $value->id_creation . "'>";
                echo "<td>" . $value->id_creation . "</td>"; // Afficher l'ID de la création
                echo "<td>" . $value->title . "</td>"; // Afficher le titre de la création
                echo "<td>" . $value->description . "</td>"; // Afficher la description de la création
                echo "<td>" . $value->created_at . "</td>"; // Afficher la date de création
                echo "<td><img src='" . $value->picture . "' class='picture'></td>"; // Afficher l'image de la création
                echo "<td>";
                echo "<a href='index.php?controller=creation&action=showCreation&id=" . $value->id_creation . "'><i class='fas fa-eye'></i></a> "; // Lien pour voir la création
                echo "<a href='index.php?controller=creation&action=updateCreation&id=" . $value->id_creation . "'><i class='fas fa-pen'></i></a> "; // Lien pour modifier la création
                echo "<button class='btn btn-danger delete-creation' data-id='" . $value->id_creation . "'><i class='fas fa-trash-alt'></i></button>"; // Bouton pour supprimer la création
                echo "</td>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>
