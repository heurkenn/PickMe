<?php
// Paramètres de connexion à la base de données
$servername = "localhost";
$username = "ProjetR";
$password = "Paulympe742@";
$dbname = "maBaseDeDonnees";

// Connexion à la base de données
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connexion établie" . "<br>";

// Sécurisation des données reçues du formulaire
$pseudonyme = $conn->real_escape_string($_POST['Pseudonyme']);
$motDePasse = $conn->real_escape_string($_POST['MotDePasse']);

// Préparation de la requête SQL pour sélectionner l'utilisateur
$sql = "SELECT MotDePasse FROM Utilisateurs WHERE Pseudonyme = '$pseudonyme'";

$result = mysqli_query( $conn, $sql );

if ($result->num_rows > 0) {
    // Récupération du mot de passe hashé dans la base de données
    $row = $result->fetch_assoc();
    $motDePasseHash = $row['MotDePasse'];

    // Vérification du mot de passe
    if (password_verify($motDePasse, $motDePasseHash)) {
        echo "Connexion réussie. Bienvenue, " . $pseudonyme . "!";
        // Redirection ou démarrage d'une session ici
        // session_start();
        // $_SESSION['pseudonyme'] = $pseudonyme;
        // header('Location: espace_membre.php'); // Décommentez pour activer la redirection
    } else {
        echo "Erreur : Mot de passe incorrect.";
    }
} else {
    echo "Erreur : Utilisateur non trouvé.";
}

// Fermeture de la connexion
$conn->close();

