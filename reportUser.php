<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: InsCon.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["receiver_id"]) && isset($_POST["report_message"])) {
        $userId = $_SESSION['user_id'];
        $receiverId = $_POST["receiver_id"];
        $reportMessage = $_POST["report_message"];

        // Connectez-vous à votre base de données
        $servername = "localhost";
        $username = "ProjetR";
        $password = "Paulympe742@";
        $dbname = "InfoUser";

        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Insérer le rapport dans la base de données
        $insertQuery = "INSERT INTO Report (Idsignal, IdProbleme, Horaire, MessageReport) VALUES ('$userId', '$receiverId', NOW(), '$reportMessage')";
        if (mysqli_query($conn, $insertQuery)) {
            echo "Report envoyé avec succès.";
        } else {
            echo "Erreur lors de l'envoi du report: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    } else {
        echo "Paramètres manquants.";
    }
} else {
    echo "Méthode non autorisée.";
}

