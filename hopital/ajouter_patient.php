<?php
include "config/database.php";

$message = "";

// si le formulaire est envoye
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // on recupere les valeurs
    $nom = trim($_POST["nom"]);
    $prenom = trim($_POST["prenom"]);
    $date_naissance = trim($_POST["date_naissance"]);
    $adresse = trim($_POST["adresse"]);
    $telephone = trim($_POST["telephone"]);

    // on verifie que tout est rempli
    if (!empty($nom) && !empty($prenom) && !empty($date_naissance) && !empty($adresse) && !empty($telephone)) {

        // on prepare la requete
        $stmt = $conn->prepare("INSERT INTO patients (nom, prenom, date_naissance, adresse, telephone) VALUES (?, ?, ?, ?, ?)");

        // on met les valeurs
        $stmt->bind_param("sssss", $nom, $prenom, $date_naissance, $adresse, $telephone);

        // on execute
        if ($stmt->execute()) {
            header("Location: patients.php");
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

$titrePage = "Ajouter patient";
include "includes/header.php";
?>

<div class="container">
    <h2>Ajouter un patient</h2>

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

        <label>Date de naissance :</label>
        <input type="date" name="date_naissance">

        <label>Adresse :</label>
        <input type="text" name="adresse">

        <label>Telephone :</label>
        <input type="text" name="telephone">

        <button type="submit">Ajouter</button>
    </form>
</div>

<?php include "includes/footer.php"; ?>