<?php
include "config/database.php";

include "config/database.php";
// on donne un titre a la page
$titrePage = "Ajouter un medecin";

// on cree une variable pour la recherche
$recherche = "";

// on cree un tableau vide pour les patients
$patients = [];

// on verifie si le formulaire a ete envoye
if (isset($_GET["recherche"])) {

    // on recupere le texte tape par l'utilisateur
    $recherche = trim($_GET["recherche"]);

    // on prepare la valeur pour le like
    $mot = "%" . $recherche . "%";

    // on prepare la requete pour chercher par nom ou prenom
    $stmt = $conn->prepare("SELECT * FROM patients WHERE nom LIKE ? OR prenom LIKE ?");

    // on met les valeurs dans la requete
    $stmt->bind_param("ss", $mot, $mot);

    // on execute la requete
    $stmt->execute();

    // on recupere le resultat
    $resultat = $stmt->get_result();

    // on transforme le resultat en tableau
    while ($ligne = $resultat->fetch_assoc()) {
        $patients[] = $ligne;
    }

    // on ferme la requete
    $stmt->close();

} else {

    // si aucune recherche n'est faite, on affiche tous les patients
    $sql = "SELECT * FROM patients";
    $resultat = $conn->query($sql);

    // on transforme le resultat en tableau
    if ($resultat->num_rows > 0) {
        while ($ligne = $resultat->fetch_assoc()) {
            $patients[] = $ligne;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Recherche des Patients</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="header">
    <h1>Systeme de Gestion Hospitalier</h1>
</div>

<div class="container">
    <h2>Recherche de Patients</h2>

    <form method="GET" action="" class="form-recherche">
        <input type="text" name="recherche" placeholder="Entrer un nom ou un prenom" value="<?php echo $recherche; ?>">
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
        </tr>

        <?php
        // on verifie si on a trouve des patients
        if (!empty($patients)) {

            // on affiche les patients avec foreach
            foreach ($patients as $p) {
                echo "<tr>";
                echo "<td>" . $p["id"] . "</td>";
                echo "<td>" . $p["nom"] . "</td>";
                echo "<td>" . $p["prenom"] . "</td>";
                echo "<td>" . $p["date_naissance"] . "</td>";
                echo "<td>" . $p["adresse"] . "</td>";
                echo "<td>" . $p["telephone"] . "</td>";
                echo "</tr>";
            }

        } else {

            // si aucun patient n'est trouve
            echo "<tr>";
            echo "<td colspan='6'>Aucun patient trouve</td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>

</body>
</html>