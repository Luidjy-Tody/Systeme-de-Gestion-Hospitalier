<?php
include "config/database.php";

$titrePage = "Rendez-vous";
include "includes/header.php";

// on prepare la requete pour lire les rendez-vous avec le patient
$sql = "SELECT rendez_vous.*, patients.nom, patients.prenom
        FROM rendez_vous
        JOIN patients ON rendez_vous.patient_id = patients.id";

// on execute la requete
$resultat = $conn->query($sql);

// on cree un tableau vide
$rendezvous = [];

// on remplit le tableau
if ($resultat->num_rows > 0) {
    while ($ligne = $resultat->fetch_assoc()) {
        $rendezvous[] = $ligne;
    }
}
?>

<div class="container">
    <h2>Liste des rendez-vous</h2>

    <a class="btn-ajouter" href="ajouter_rendez_vous.php">Ajouter un rendez-vous</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Patient</th>
            <th>Date et heure</th>
            <th>Motif</th>
        </tr>

        <?php
        // on verifie si on a des rendez-vous
        if (!empty($rendezvous)) {

            // on affiche avec foreach
            foreach ($rendezvous as $rdv) {
                echo "<tr>";
                echo "<td>" . $rdv["id"] . "</td>";
                echo "<td>" . htmlspecialchars($rdv["nom"]) . " " . htmlspecialchars($rdv["prenom"]) . "</td>";
                echo "<td>" . htmlspecialchars($rdv["date_heure"]) . "</td>";
                echo "<td>" . htmlspecialchars($rdv["motif"]) . "</td>";
                echo "</tr>";
            }

        } else {

            // si aucun rendez-vous
            echo "<tr>";
            echo "<td colspan='4'>Aucun rendez-vous trouve</td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>

<?php include "includes/footer.php"; ?>