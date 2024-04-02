<?php
session_start();


$servername = "localhost";
$username = "ProjetR";
$password = "Paulympe742@";
$dbname = "InfoUser";

// Connexion à la base de données
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if (!isset($_SESSION['user_id'])) {
    header("Location: InsCon.php");
    exit();
}


$userId = $_SESSION['user_id'];

// Vérifier s'il existe des informations dans la table Gouts pour cet utilisateur
$sqlGouts = "SELECT * FROM Gouts WHERE UtilisateurId = '$userId'";
$resultGouts = mysqli_query($conn, $sqlGouts);

if (!($resultGouts->num_rows > 0)) {
    // Il existe des informations dans la table Gouts pour cet utilisateur
    // Vous pouvez effectuer les actions appropriées ici

    // Redirection vers une autre page par exemple
    header("Location: gouts.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PICK ME !</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>

<body>
    <header>
        <h1><a href="index.php" class="custom-link">PICK ME !</a></h1>
        <nav>
            <ul>
                <li><a href="#">Accueil</a></li>
                <li><a href="#">À propos</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>

    </header>


    <div class="main">
        <div class="account-button-container">
            <a href="profil.php" class="account-button">Mon compte</a>
        </div>
        <h1><a href="deconnexion.php">Déconnexion</a></h1>

    </div>
    <footer>
        <p>&copy; 2024 Mon Site Web. Tous droits réservés.</p>
    </footer>
    <script src="script.js"></script>
</body>

</html>