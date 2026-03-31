<?php
include "config/database.php";

$message = "";

// si le formulaire est envoye
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // on recupere les valeurs
    $nom = trim($_POST["nom"]);
    $prenom = trim($_POST["prenom"]);
    $specialite = trim($_POST["specialite"]);

    // on verifie que tout est rempli
    if (!empty($nom) && !empty($prenom) && !empty($specialite)) {

        // on prepare la requete
        $stmt = $conn->prepare("INSERT INTO medecins (nom, prenom, specialite) VALUES (?, ?, ?)");

        // on met les valeurs dans la requete
        $stmt->bind_param("sss", $nom, $prenom, $specialite);

        // on execute
        if ($stmt->execute()) {
            header("Location: medecins.php");
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

$titrePage = "Ajouter medecin";
include "includes/header.php";
?>

<div class="container">
    <h2>Ajouter un medecin</h2>

    <?php
    // on affiche le message si besoin
    if (!empty($message)) {
        echo "<p class='message'>" . $message . "</p>";
    }
    ?>

    <form method="POST" action="">
        <label>Nom :</label>
        <input type="text" name="nom">

        <label>Prenom :</label>
        <input type="text" name="prenom">

        <label>Specialite :</label>
        <input type="text" name="specialite">

        <button type="submit">Ajouter</button>
    </form>
</div>

<?php include "includes/footer.php"; ?>