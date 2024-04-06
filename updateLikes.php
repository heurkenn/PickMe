<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Rediriger vers la page de connexion
    header("Location: InsCon.php");
    exit();
}

// Récupérer l'ID de l'utilisateur connecté
$userId = $_SESSION['user_id'];

// Vérifier si les données POST ont été envoyées
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['profileId']) && isset($_POST['action'])) {
    // Récupérer les données envoyées par AJAX
    $profileId = $_POST['profileId'];
    $action = $_POST['action'];

    // Connexion à la base de données
    $servername = "localhost";
    $username = "ProjetR";
    $password = "Paulympe742@";
    $dbname = "InfoUser";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "INSERT INTO LikeList (IdEnvoi, IdRecoi, Etat)
    VALUES ('$userId', '$profileId', '$action')";

    // Exécuter la requête SQL
    if (mysqli_query($conn, $query)) {
        echo "Mise à jour des likes réussie.";
    } else {
        echo "Erreur lors de la mise à jour des likes : " . mysqli_error($conn);
    }

    // Fermer la connexion à la base de données
    mysqli_close($conn);
} else {
    // Redirection vers la page d'accueil si les données POST ne sont pas définies
    header("Location: index.php");
    exit();
}