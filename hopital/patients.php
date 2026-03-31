<?php
include "config/database.php";

$titrePage = "Patients";
include "includes/header.php";

// on cree la variable de recherche
$recherche = "";

// on cree un tableau vide
$patients = [];

// si une recherche est faite
if (isset($_GET["recherche"]) && !empty(trim($_GET["recherche"]))) {

    // on recupere le texte tape
    $recherche = trim($_GET["recherche"]);

    // on prepare le mot pour le like
    $mot = "%" . $recherche . "%";

    // on prepare la requete
    $stmt = $conn->prepare("SELECT * FROM patients WHERE nom LIKE ? OR prenom LIKE ?");

    // on met les valeurs dans la requete
    $stmt->bind_param("ss", $mot, $mot);

    // on execute
    $stmt->execute();

    // on recupere le resultat
    $resultat = $stmt->get_result();

    // on remplit le tableau
    while ($ligne = $resultat->fetch_assoc()) {
        $patients[] = $ligne;
    }

    // on ferme la requete
    $stmt->close();

} else {

    // sinon on prend tous les patients
    $sql = "SELECT * FROM patients";
    $resultat = $conn->query($sql);

    // on remplit le tableau
    if ($resultat->num_rows > 0) {
        while ($ligne = $resultat->fetch_assoc()) {
            $patients[] = $ligne;
        }
    }
}
?>

<div class="container">
    <h2>Liste des Patients</h2>

    <a class="btn-ajouter" href="ajouter_patient.php">Ajouter un patient</a>

    <form method="GET" action="" class="form-recherche">
        <input
            type="text"
            name="recherche"
            placeholder="Rechercher par nom ou prenom"
            value="<?php echo htmlspecialchars($recherche); ?>"
        >
        <button type="submit">Rechercher</button>
    </form>
    <table>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Date de naissance</th>
            <th>Adresse</th>
            <th>Telephone</th>
            <th>Actions</th>
        </tr>
        <?php
        // on verifie si on a des patients
        if (!empty($patients)) {
            // on affiche avec foreach
            foreach ($patients as $p) {
                echo "<tr>";
                echo "<td>" . $p["id"] . "</td>";
                echo "<td>" . htmlspecialchars($p["nom"]) . "</td>";
                echo "<td>" . htmlspecialchars($p["prenom"]) . "</td>";
                echo "<td>" . htmlspecialchars($p["date_naissance"]) . "</td>";
                echo "<td>" . htmlspecialchars($p["adresse"]) . "</td>";
                echo "<td>" . htmlspecialchars($p["telephone"]) . "</td>";
                echo "<td class='actions'>";
                echo "<a class='btn-modifier' href='modifier_patient.php?id=" . $p["id"] . "'>Modifier</a>";
                echo "<a class='btn-supprimer' href='supprimer_patient.php?id=" . $p["id"] . "'>Supprimer</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {

            // si rien n'est trouve
            echo "<tr>";
            echo "<td colspan='7'>Aucun patient trouve</td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>

<?php include "includes/footer.php"; ?>