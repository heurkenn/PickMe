<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Rediriger l'utilisateur vers la page de connexion ou afficher un message d'erreur
    exit();
}

// Vérifiez si l'identifiant du message à supprimer a été envoyé via la méthode POST
if (!isset($_POST['message_id'])) {
    // Rediriger l'utilisateur vers une page d'erreur ou afficher un message d'erreur
    exit();
}

// Récupérez l'identifiant du message à supprimer depuis la requête POST
$messageId = $_POST['message_id'];

// Effectuez la suppression du message dans la base de données
$servername = "localhost";
$username = "ProjetR";
$password = "Paulympe742@";
$dbname = "votre_base_de_donnees";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Préparez et exécutez la requête SQL pour supprimer le message
$sql = "DELETE FROM messages WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $messageId);
mysqli_stmt_execute($stmt);

// Vérifiez si la suppression a réussi
if (mysqli_stmt_affected_rows($stmt) > 0) {
    // La suppression a réussi, vous pouvez renvoyer une réponse succès si nécessaire
    echo "Le message a été supprimé avec succès.";
} else {
    // La suppression a échoué, vous pouvez renvoyer un message d'erreur si nécessaire
    echo "Erreur lors de la suppression du message.";
}

// Fermez la connexion à la base de données
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
