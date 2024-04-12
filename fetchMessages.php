<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("HTTP/1.1 403 Forbidden");
    exit();
}

if (!isset($_GET['receiver_id'])) {
    header("HTTP/1.1 400 Bad Request");
    exit();
}

$userId = $_SESSION['user_id'];

$receiverId = $_GET['receiver_id'];

$servername = "localhost";
$username = "ProjetR";
$password = "Paulympe742@";
$dbname = "InfoUser";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    header("HTTP/1.1 500 Internal Server Error");
    exit();
}

$query = "SELECT UtilisateurId AS sender_id, MessageEnv AS message_content, DATE_FORMAT(Horaire, '%d/%m/%Y %H:%i') AS time_stamp, IdMessage AS id_msg FROM Messages WHERE (UtilisateurId = $userId AND UtilisateurIdBis = $receiverId) OR (UtilisateurId = $receiverId AND UtilisateurIdBis = $userId) ORDER BY Horaire ASC";
$result = mysqli_query($conn, $query);

$messages = [];

while ($row = mysqli_fetch_assoc($result)) {
    $messages[] = $row;
}

header('Content-Type: application/json');
echo json_encode($messages);

mysqli_free_result($result);
mysqli_close($conn);