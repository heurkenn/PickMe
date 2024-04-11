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

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Récupère l'ID de l'utilisateur dont on veut afficher les messages
$user_id = $_GET['user_id'];

// Requête pour récupérer les messages de l'utilisateur
$sql = "SELECT Horaire as time_stamp,MessageEnv as message_content, UtilisateurIdBis as recoi FROM Messages WHERE UtilisateurId = $user_id";
$result = mysqli_query($conn, $sql);

$messages = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $messages[] = $row;
    }
}

// Renvoie les messages au format JSON
header('Content-Type: application/json');
echo json_encode($messages);