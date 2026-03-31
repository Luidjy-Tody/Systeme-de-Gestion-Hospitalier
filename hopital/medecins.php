<?php
include "config/database.php";

$titrePage = "Medecins";
include "includes/header.php";

// on prepare la requete pour lire tous les medecins
$sql = "SELECT * FROM medecins";

// on execute la requete
$resultat = $conn->query($sql);

// on cree un tableau vide
$medecins = [];

// on remplit le tableau avec les resultats
if ($resultat->num_rows > 0) {
    while ($ligne = $resultat->fetch_assoc()) {
        $medecins[] = $ligne;
    }
}
?>

<div class="container">
    <h2>Liste des medecins</h2>

    <a class="btn-ajouter" href="ajouter_medecin.php">Ajouter un medecin</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Specialite</th>
            <th>Actions</th>
        </tr>

        <?php
        // on verifie si on a des medecins
        if (!empty($medecins)) {

            // on affiche chaque medecin avec foreach
            foreach ($medecins as $m) {
                echo "<tr>";
                echo "<td>" . $m["id"] . "</td>";
                echo "<td>" . htmlspecialchars($m["nom"]) . "</td>";
                echo "<td>" . htmlspecialchars($m["prenom"]) . "</td>";
                echo "<td>" . htmlspecialchars($m["specialite"]) . "</td>";
                echo "<td class='actions'>";
                echo "<a class='btn-modifier' href='modifier_medecin.php?id=" . $m["id"] . "'>Modifier</a>";
                echo "<a class='btn-supprimer' href='supprimer_medecin.php?id=" . $m["id"] . "'>Supprimer</a>";
                echo "</td>";
                echo "</tr>";
            }

        } else {

            // si aucun medecin n'existe
            echo "<tr>";
            echo "<td colspan='5'>Aucun medecin trouve</td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>

<?php include "includes/footer.php"; ?>