<?php
include "config/database.php";

// on cree les variables
$id = "";
$nom = "";
$prenom = "";
$date_naissance = "";
$adresse = "";
$telephone = "";
$message = "";

// si le formulaire est envoye
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // on recupere les valeurs
    $id = trim($_POST["id"]);
    $nom = trim($_POST["nom"]);
    $prenom = trim($_POST["prenom"]);
    $date_naissance = trim($_POST["date_naissance"]);
    $adresse = trim($_POST["adresse"]);
    $telephone = trim($_POST["telephone"]);

    // on verifie que tout est rempli
    if (!empty($id) && !empty($nom) && !empty($prenom) && !empty($date_naissance) && !empty($adresse) && !empty($telephone)) {

        // on prepare la requete update
        $stmt = $conn->prepare("UPDATE patients SET nom = ?, prenom = ?, date_naissance = ?, adresse = ?, telephone = ? WHERE id = ?");

        // on met les valeurs dans la requete
        $stmt->bind_param("sssssi", $nom, $prenom, $date_naissance, $adresse, $telephone, $id);

        // on execute
        if ($stmt->execute()) {
            header("Location: patients.php");
            exit();
        } else {
            $message = "Erreur lors de la modification.";
        }

        // on ferme
        $stmt->close();

    } else {
        $message = "Veuillez remplir tous les champs.";
    }
}

// si on a un id dans l'url
if (isset($_GET["id"])) {

    // on recupere l'id
    $id = $_GET["id"];

    // on prepare la requete
    $stmt = $conn->prepare("SELECT * FROM patients WHERE id = ?");

    // on met l'id
    $stmt->bind_param("i", $id);

    // on execute
    $stmt->execute();

    // on recupere le resultat
    $resultat = $stmt->get_result();

    // on cree un tableau
    $patients = [];

    // on remplit le tableau
    while ($ligne = $resultat->fetch_assoc()) {
        $patients[] = $ligne;
    }

    // on prend le premier patient
    if (!empty($patients)) {
        $patient = $patients[0];
        $id = $patient["id"];
        $nom = $patient["nom"];
        $prenom = $patient["prenom"];
        $date_naissance = $patient["date_naissance"];
        $adresse = $patient["adresse"];
        $telephone = $patient["telephone"];
    } else {
        $message = "Patient introuvable.";
    }

    // on ferme
    $stmt->close();
}

$titrePage = "Modifier patient";
include "includes/header.php";
?>

<div class="container">
    <h2>Modifier un patient</h2>

    <?php
    // on affiche le message si besoin
    if (!empty($message)) {
        echo "<p class='message'>" . $message . "</p>";
    }
    ?>

    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

        <label>Nom :</label>
        <input type="text" name="nom" value="<?php echo htmlspecialchars($nom); ?>">

        <label>Prenom :</label>
        <input type="text" name="prenom" value="<?php echo htmlspecialchars($prenom); ?>">

        <label>Date de naissance :</label>
        <input type="date" name="date_naissance" value="<?php echo htmlspecialchars($date_naissance); ?>">

        <label>Adresse :</label>
        <input type="text" name="adresse" value="<?php echo htmlspecialchars($adresse); ?>">

        <label>Telephone :</label>
        <input type="text" name="telephone" value="<?php echo htmlspecialchars($telephone); ?>">

        <button type="submit">Enregistrer</button>
    </form>
</div>

<?php include "includes/footer.php"; ?>