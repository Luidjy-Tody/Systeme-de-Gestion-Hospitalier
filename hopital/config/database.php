<?php
// on prépare les informations pour se connecter à la base de donnees
$host = "localhost";
$user = "root";
$password = "";
$dbname = "hopital";
// on cree la connexion avec MySQL
$conn = new mysqli($host, $user, $password, $dbname);
// on verifie si la connexion a marche
// si ce n'est pas bon, on arrête le programme et on montre un message
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}
// on met les caractères en utf8 pour bien afficher les accents
$conn->set_charset("utf8");
?>