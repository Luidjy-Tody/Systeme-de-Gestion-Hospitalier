<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo isset($titrePage) ? $titrePage : "Systeme"; ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="header">
    <h1>Systeme de Gestion Hospitalier</h1>
</div>

<div class="navbar">
    <a href="patients.php">Patients</a>
    <a href="rendez_vous.php">Rendez-vous</a>
    <a href="medecins.php">Medecins</a>
    <a href="rapport_rendez_vous.php">Rapport</a>
</div>