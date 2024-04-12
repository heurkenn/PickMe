<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: InsCon.php");
    exit();
}

// Récupérez l'ID de l'utilisateur connecté
$userId = $_SESSION['user_id'];

// Vérifiez si l'ID du message a été envoyé via POST
if(isset($_POST["message_id"])) {
    $msgId = $_POST["message_id"];

    // Connexion à la base de données
    $servername = "localhost";
    $username = "ProjetR";
    $password = "Paulympe742@";
    $dbname = "InfoUser";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Préparer la requête SQL pour récupérer l'ID de l'utilisateur associé au message
    $query = "SELECT UtilisateurId FROM Messages WHERE IdMessage = $msgId";
    $result = mysqli_query($conn, $query);
    
    // Vérifiez si la requête a réussi et si l'utilisateur associé au message est le même que l'utilisateur connecté
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $messageUserId = $row['UtilisateurId'];
        
        // Si l'utilisateur associé au message est le même que l'utilisateur connecté, supprimez le message
        if ($messageUserId == $userId) {
            // Préparer et exécuter la requête de suppression du message
            $deleteQuery = "DELETE FROM Messages WHERE IdMessage = $msgId";
            mysqli_query($conn, $deleteQuery);
        }
    }
    
    // Fermer la connexion à la base de données
    mysqli_close($conn);
}


