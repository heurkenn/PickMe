<?php
// Paramètres de connexion à la base de données
$servername = "localhost";
$username = "gwenn";
$password = "Salut333";
$dbname = "maBaseDeDonnees";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Sécurisation des données reçues du formulaire
$pseudonyme = $conn->real_escape_string($_POST['Pseudonyme']);
$motDePasse = $conn->real_escape_string($_POST['Code']);

// Préparation de la requête SQL pour sélectionner l'utilisateur
$sql = "SELECT MotDePasse FROM Utilisateurs WHERE Pseudonyme = '$pseudonyme'";

$result = $conn->query($sql);

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
?>
