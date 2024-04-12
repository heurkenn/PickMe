<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("HTTP/1.1 403 Forbidden");
    exit();
}

// Vérifiez si le paramètre receiver_id est présent
if (!isset($_GET['receiver_id'])) {
    header("HTTP/1.1 400 Bad Request");
    exit();
}

// Récupérez l'ID de l'utilisateur connecté
$userId = $_SESSION['user_id'];

// Récupérez l'ID du destinataire depuis les paramètres GET
$receiverId = $_GET['receiver_id'];

// Connexion à la base de données
$servername = "localhost";
$username = "ProjetR";
$password = "Paulympe742@";
$dbname = "InfoUser";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    header("HTTP/1.1 500 Internal Server Error");
    exit();
}

// Sélectionnez les messages de la conversation entre l'utilisateur connecté et le destinataire
$query = "SELECT UtilisateurId AS sender_id, MessageEnv AS message_content, DATE_FORMAT(Horaire, '%d/%m/%Y %H:%i') AS time_stamp, IdMessage AS id_msg FROM Messages WHERE (UtilisateurId = $userId AND UtilisateurIdBis = $receiverId) OR (UtilisateurId = $receiverId AND UtilisateurIdBis = $userId) ORDER BY Horaire ASC";
$result = mysqli_query($conn, $query);

// Créez une variable pour stocker les messages
$messages = [];

// Parcourez les résultats de la requête et ajoutez-les à la variable de messages
while ($row = mysqli_fetch_assoc($result)) {
    $messages[] = $row;
}

// Convertissez les messages en format JSON et renvoyez-les
header('Content-Type: application/json');
echo json_encode($messages);

// Fermez la connexion à la base de données
mysqli_free_result($result);
mysqli_close($conn);