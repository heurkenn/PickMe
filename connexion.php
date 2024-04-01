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
echo "Connexion établie" . "<br>";

// Sécurisation des données reçues du formulaire
$pseudonyme = mysqli_real_escape_string($conn, $_POST['Pseudonyme']);
$motDePasse = mysqli_real_escape_string($conn, $_POST['MotDePasse']);

// Préparation de la requête SQL pour sélectionner l'utilisateur et son ID
$sql = "SELECT id, MotDePasse FROM Utilisateurs WHERE Pseudonyme = '$pseudonyme'";

$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $motDePasseHash = $row['MotDePasse'];
    if (password_verify($motDePasse, $motDePasseHash)) {
        $_SESSION['user_id'] = $row['id'];
        header("Location: index.php");
        exit();
    } else {
        
        header("Location: InsCon.php");
    }
} else {
    echo "Utilisateur non trouvé";
}

// Fermeture de la connexion
$conn->close();

