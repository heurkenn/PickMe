<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: InsCon.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['receiver_id']) && isset($_POST['message'])) {
    $senderId = $_SESSION['user_id'];
    $receiverId = $_POST['receiver_id'];
    $message = $_POST['message'];

    $servername = "localhost";
    $username = "ProjetR";
    $password = "Paulympe742@";
    $dbname = "InfoUser";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "INSERT INTO Messages (UtilisateurId, UtilisateurIdBis, MessageEnv, Horaire) VALUES (?, ?, ?, NOW())";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "iis", $senderId, $receiverId, $message);
    if (mysqli_stmt_execute($stmt)) {
        echo "Message envoyé avec succès.";
    } else {
        echo "Erreur lors de l'envoi du message : " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    header("Location: index.php");
    exit();
}

