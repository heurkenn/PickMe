<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: InsCon.php");
    exit();
}

// Vérifier si les données POST ont été envoyées
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['receiver_id']) && isset($_POST['message'])) {
    // Récupérer les données envoyées par le formulaire
    $senderId = $_SESSION['user_id'];
    $receiverId = $_POST['receiver_id'];
    $message = $_POST['message'];

    // Connexion à la base de données
    $servername = "localhost";
    $username = "ProjetR";
    $password = "Paulympe742@";
    $dbname = "InfoUser";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Préparer et exécuter la requête d'insertion du message dans la base de données
    $query = "INSERT INTO Messages (UtilisateurId, UtilisateurIdBis, MessageEnv, Horaire) VALUES (?, ?, ?, NOW())";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "iis", $senderId, $receiverId, $message);
    if (mysqli_stmt_execute($stmt)) {
        echo "Message envoyé avec succès.";
    } else {
        echo "Erreur lors de l'envoi du message : " . mysqli_error($conn);
    }

    // Fermer la connexion à la base de données
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    // Redirection vers la page d'accueil si les données POST ne sont pas définies
    header("Location: index.php");
    exit();
}

