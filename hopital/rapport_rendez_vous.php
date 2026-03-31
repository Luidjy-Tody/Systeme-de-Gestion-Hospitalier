<?php
include "config/database.php";

$titrePage = "Rapport des rendez-vous";
include "includes/header.php";

// on prepare la requete pour recuperer les rendez-vous des 7 prochains jours
$sql = "SELECT rendez_vous.*, patients.nom, patients.prenom
        FROM rendez_vous
        JOIN patients ON rendez_vous.patient_id = patients.id
        WHERE rendez_vous.date_heure BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 7 DAY)
        ORDER BY rendez_vous.date_heure ASC";

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
    <h2>Rapport des rendez-vous a venir dans les 7 prochains jours</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Patient</th>
            <th>Date et heure</th>
            <th>Motif</th>
            <th>Medecin</th>
        </tr>

        <?php
        // on verifie si on a trouve des rendez-vous
        if (!empty($rendezvous)) {

            // on affiche avec foreach
            foreach ($rendezvous as $rdv) {
                echo "<tr>";
                echo "<td>" . $rdv["id"] . "</td>";
                echo "<td>" . htmlspecialchars($rdv["nom"]) . " " . htmlspecialchars($rdv["prenom"]) . "</td>";
                echo "<td>" . htmlspecialchars($rdv["date_heure"]) . "</td>";
                echo "<td>" . htmlspecialchars($rdv["motif"]) . "</td>";
                echo "<td>Non attribue</td>";
                echo "</tr>";
            }

        } else {

            // si aucun rendez-vous n'est trouve
            echo "<tr>";
            echo "<td colspan='5'>Aucun rendez-vous a venir dans les 7 prochains jours</td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>

<?php include "includes/footer.php"; ?>