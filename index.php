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

// Définissez le nombre de profils à afficher
$nombreProfils = 3; // Vous pouvez ajuster le nombre selon vos besoins

// Récupérer un nombre spécifié d'utilisateurs de manière aléatoire avec leur biographie
$sqlUtilisateurs = "SELECT Utilisateurs.*, Gouts.Biographie FROM Utilisateurs 
                    JOIN Gouts ON Utilisateurs.id = Gouts.UtilisateurId 
                    ORDER BY RAND() LIMIT $nombreProfils";
$resultUtilisateurs = mysqli_query($conn, $sqlUtilisateurs);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PICK ME !</title>
    <link rel="stylesheet" href="stylesheet.css">
    <style>
        .profile-card {
            display: block;
        }

        .additional-info {
            display: none;
        }
    </style>
</head>

<body>
    <header>
        <h1>PICK ME !</h1>
        <nav>
            <ul>
                <li><a href="#">À propos</a></li>
                <li><a href="#">Abonnement</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>

    <div class="main">
        <div class="account-button-container">
            <a href="profil.php" class="account-button">Mon compte</a>
        </div>
        <h1><a href="deconnexion.php">Déconnexion</a></h1>

        <!-- Affichage des profils -->
        <?php
        while ($row = mysqli_fetch_assoc($resultUtilisateurs)) {
            echo "<div class='profile-card'>";
            echo "<h2>" . $row['Pseudonyme'] . "</h2>";
            echo "<p>Nom: " . $row['Nom'] . "</p>";
            echo "<p>Prénom: " . $row['Prenom'] . "</p>";
            echo "<button onclick='showAdditionalInfo(" . $row['id'] . ")'>Plus d'infos</button>";
            // Ajouter un conteneur pour les informations supplémentaires
            echo "<div id='additional-info-" . $row['id'] . "' class='additional-info'>";
            echo "<p>Biographie: " . $row['Biographie'] . "</p>";
            // Afficher d'autres informations de la table Gouts si nécessaire
            echo "<button onclick='hideAdditionalInfo(" . $row['id'] . ")'>Masquer les infos</button>";
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>
    <footer>
        <p>&copy; 2024 Mon Site Web. Tous droits réservés.</p>
    </footer>
</body>

</html>
