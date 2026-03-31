<?php
include "config/database.php";

$message = "";

// on cree un tableau vide pour les patients
$patients = [];

// on prepare la requete pour lire les patients
$sqlPatients = "SELECT * FROM patients";

// on execute la requete
$resultatPatients = $conn->query($sqlPatients);

// on remplit le tableau
if ($resultatPatients->num_rows > 0) {
    while ($ligne = $resultatPatients->fetch_assoc()) {
        $patients[] = $ligne;
    }
}

// si le formulaire est envoye
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // on recupere les valeurs
    $patient_id = trim($_POST["patient_id"]);
    $date_heure = trim($_POST["date_heure"]);
    $motif = trim($_POST["motif"]);

    // on verifie que tout est rempli
    if (!empty($patient_id) && !empty($date_heure) && !empty($motif)) {

        // on prepare la requete insert
        $stmt = $conn->prepare("INSERT INTO rendez_vous (patient_id, date_heure, motif) VALUES (?, ?, ?)");

        // on met les valeurs dans la requete
        $stmt->bind_param("iss", $patient_id, $date_heure, $motif);

        // on execute
        if ($stmt->execute()) {
            header("Location: rendez_vous.php");
            exit();
        } else {
            $message = "Erreur lors de l'ajout.";
        }

        // on ferme
        $stmt->close();

    } else {
        $message = "Veuillez remplir tous les champs.";
    }
}

$titrePage = "Ajouter rendez-vous";
include "includes/header.php";
?>

<div class="container">
    <h2>Ajouter un rendez-vous</h2>

    <?php
    // on affiche le message si besoin
    if (!empty($message)) {
        echo "<p class='message'>" . $message . "</p>";
    }
    ?>

    <form method="POST" action="">
        <label>Patient :</label>
        <select name="patient_id">
            <option value="">Choisir un patient</option>

            <?php
            // on affiche les patients dans la liste
            foreach ($patients as $p) {
                echo "<option value='" . $p["id"] . "'>";
                echo htmlspecialchars($p["nom"]) . " " . htmlspecialchars($p["prenom"]);
                echo "</option>";
            }
            ?>
        </select>

        <label>Date et heure :</label>
        <input type="datetime-local" name="date_heure">

        <label>Motif :</label>
        <input type="text" name="motif">

        <button type="submit">Ajouter</button>
    </form>
</div>

<?php include "includes/footer.php"; ?>