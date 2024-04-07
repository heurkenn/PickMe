<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: InsCon.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["receiver_id"])) {
        $userId = $_SESSION['user_id'];
        $receiverId = $_POST["receiver_id"];

        // Connectez-vous à votre base de données
        $servername = "localhost";
        $username = "ProjetR";
        $password = "Paulympe742@";
        $dbname = "InfoUser";

        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Supprimer le match de la base de données
        $deleteQuery = "DELETE FROM LikeList WHERE (IdEnvoi = $userId AND IdRecoi = $receiverId) OR (IdEnvoi = $receiverId AND IdRecoi = $userId)";
        if (mysqli_query($conn, $deleteQuery)) {
            echo "Match supprimé avec succès.";
        } else {
            echo "Erreur lors de la suppression du match: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    } else {
        echo "Paramètres manquants.";
    }
} else {
    echo "Méthode non autorisée.";
}

