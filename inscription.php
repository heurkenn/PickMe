<?php
// Connexion à la base de données (à remplacer avec vos propres informations)
$servername = "localhost";
$username = "ProjetR";
$password = "Paulympe742@";
$dbname = "maBaseDeDonnees";

// Connexion à la base de données
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


// Informations statiques à insérer
$nom = $_POST['Nom'];
$prenom = $_POST['Prenom'];
$dateNaissance = $_POST['DateNaissance']; 
$pseudonyme = $_POST['Pseudonyme'];
$email = $_POST['Email'];
$motDePasse = $_POST['MotDePasse'];

// Hachage du mot de passe
$motDePasseHache = password_hash($motDePasse, PASSWORD_DEFAULT);


// Requête SQL pour insérer les données statiques dans la table appropriée
$query = "INSERT INTO Utilisateurs (Nom, Prenom, DateNaissance, Pseudonyme, Email, MotDePasse)
        VALUES ('$nom', '$prenom', '$dateNaissance', '$pseudonyme', '$email', '$motDePasseHache')";

$result = mysqli_query($conn, $query);



// Fermeture de la connexion
mysqli_close($conn);?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Site Web</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
    <header>
        <h1>Click me!</h1>
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
    <?
    if (!$result) {
    printf("Erreur: %s\n", mysqli_error($conn));
    } else {
        echo 'Données insérées avec succès.';
    }
    ?>
    </div>
    <footer>
        <p>&copy; 2024 Mon Site Web. Tous droits réservés.</p>
    </footer>
    <script src="script.js"></script>
</body>
</html>
