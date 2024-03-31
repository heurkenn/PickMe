<?php
session_start();
// Paramètres de connexion à la base de données
$servername = "localhost";
$username = "ProjetR";
$password = "Paulympe742@";
$dbname = "InfoUser";

// Connexion à la base de données
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connexion établie" . "<br>";

// Sécurisation des données reçues du formulaire
$pseudonyme = mysqli_real_escape_string($conn, $_POST['Pseudonyme']);
$motDePasse = mysqli_real_escape_string($conn, $_POST['MotDePasse']);

// Préparation de la requête SQL pour sélectionner l'utilisateur et son ID
$sql = "SELECT id, MotDePasse FROM Utilisateurs WHERE Pseudonyme = '$pseudonyme'";

$result = mysqli_query($conn, $sql);
echo "test". "<br>";
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $motDePasseHash = $row['MotDePasse'];
    if (password_verify($motDePasse, $motDePasseHash)) {
        // Stocker l'ID de l'utilisateur dans la session
        $_SESSION['user_id'] = $row['id'];
        // Redirection vers la page d'accueil
        header("Location: index.php");
        exit(); // Assurez-vous d'arrêter l'exécution du script après la redirection
    } else {
        echo "Mot de passe incorrect";
    }
} else {
    echo "Utilisateur non trouvé";
}

// Fermeture de la connexion
$conn->close();

