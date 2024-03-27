<?php
// Activation des erreurs PHP pour le debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Paramètres de connexion à la base de données
$servername = "localhost";
$username = "gwenn";
$password = "Salut333";
$dbname = "maBaseDeDonnees";

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Vérification de la présence des données POST
if (isset($_POST['Nom'], $_POST['Prenom'], $_POST['DateNaissance'], $_POST['Pseudonyme'], $_POST['Email'], $_POST['Code'])) {

    // Hashage du mot de passe
    $passwordHash = password_hash($_POST['Code'], PASSWORD_DEFAULT);
    
    // Préparation de la requête SQL
    $stmt = $conn->prepare("INSERT INTO Utilisateurs (Nom, Prenom, DateNaissance, Pseudonyme, Email, MotDePasse) VALUES (?, ?, ?, ?, ?, ?)");
    
    // Liaison des paramètres
    $stmt->bind_param("ssssss", $_POST['Nom'], $_POST['Prenom'], $_POST['DateNaissance'], $_POST['Pseudonyme'], $_POST['Email'], $passwordHash);
    
    // Exécution de la requête
    if ($stmt->execute()) {
        // Redirection vers la page de confirmation
        header('Location: confirmation.php');
        exit;
    } else {
        // Gestion de l'erreur d'insertion
        $error = "Erreur lors de l'inscription : " . $stmt->error;
    }
    
    // Fermeture de la déclaration
    $stmt->close();
} else {
    $error = "Tous les champs sont requis.";
}

// Fermeture de la connexion
$conn->close();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription échouée</title>
    <!-- Assurez-vous d'inclure votre CSS ici si nécessaire -->
</head>
<body>
    <p>Il y a eu une erreur lors de votre inscription :</p>
    <p><?php echo htmlspecialchars($error); ?></p>
    <a href="index.php">Retourner au formulaire d'inscription</a>
</body>
</html>
