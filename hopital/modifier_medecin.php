<?php
include "config/database.php";

// on cree les variables
$id = "";
$nom = "";
$prenom = "";
$specialite = "";
$message = "";

// si le formulaire est envoye
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // on recupere les valeurs
    $id = trim($_POST["id"]);
    $nom = trim($_POST["nom"]);
    $prenom = trim($_POST["prenom"]);
    $specialite = trim($_POST["specialite"]);

    // on verifie que tout est rempli
    if (!empty($id) && !empty($nom) && !empty($prenom) && !empty($specialite)) {

        // on prepare la requete update
        $stmt = $conn->prepare("UPDATE medecins SET nom = ?, prenom = ?, specialite = ? WHERE id = ?");

        // on met les valeurs dans la requete
        $stmt->bind_param("sssi", $nom, $prenom, $specialite, $id);

        // on execute
        if ($stmt->execute()) {
            header("Location: medecins.php");
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
    $stmt = $conn->prepare("SELECT * FROM medecins WHERE id = ?");

    // on met l'id
    $stmt->bind_param("i", $id);

    // on execute
    $stmt->execute();

    // on recupere le resultat
    $resultat = $stmt->get_result();

    // on cree un tableau
    $medecins = [];

    // on remplit le tableau
    while ($ligne = $resultat->fetch_assoc()) {
        $medecins[] = $ligne;
    }

    // on prend le premier medecin
    if (!empty($medecins)) {
        $medecin = $medecins[0];
        $id = $medecin["id"];
        $nom = $medecin["nom"];
        $prenom = $medecin["prenom"];
        $specialite = $medecin["specialite"];
    } else {
        $message = "Medecin introuvable.";
    }

    // on ferme
    $stmt->close();
}

$titrePage = "Modifier medecin";
include "includes/header.php";
?>

<div class="container">
    <h2>Modifier un medecin</h2>

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

        <label>Specialite :</label>
        <input type="text" name="specialite" value="<?php echo htmlspecialchars($specialite); ?>">

        <button type="submit">Enregistrer</button>
    </form>
</div>

<?php include "includes/footer.php"; ?>