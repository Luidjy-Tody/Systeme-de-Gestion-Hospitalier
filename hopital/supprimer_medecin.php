<?php
include "config/database.php";

// on verifie si l'id existe
if (isset($_GET["id"])) {

    // on recupere l'id
    $id = $_GET["id"];

    // on prepare la requete delete
    $stmt = $conn->prepare("DELETE FROM medecins WHERE id = ?");

    // on met l'id dans la requete
    $stmt->bind_param("i", $id);

    // on execute
    $stmt->execute();

    // on ferme
    $stmt->close();
}

// on revient vers la liste
header("Location: medecins.php");
exit();
?>