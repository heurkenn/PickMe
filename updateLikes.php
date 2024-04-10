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

    // Récupérer le forfait de l'utilisateur
    $forfaitQuery = "SELECT Forfait, NombreVu FROM Utilisateurs WHERE id = $userId";
    $forfaitResult = mysqli_query($conn, $forfaitQuery);
    $forfaitRow = mysqli_fetch_assoc($forfaitResult);
    $forfait = $forfaitRow['Forfait'];
    $nombreVu = $forfaitRow['NombreVu'];

    if ($action === "non") {
        $query3 = "INSERT INTO LikeList (IdEnvoi, IdRecoi, Etat) VALUES ('$userId', '$profileId', '$action')";
        $result3 = mysqli_query($conn, $query3);
    } else {
        if ($forfait === "free" && $nombreVu >= 5) {
            // Limite de likes atteinte pour les utilisateurs avec forfait "free"
            echo "Limite atteinte";

        } else {
            // Mettre à jour le nombre de likes de l'utilisateur
            $query = "INSERT INTO LikeList (IdEnvoi, IdRecoi, Etat) VALUES ('$userId', '$profileId', '$action')";
            if (mysqli_query($conn, $query)) {
                if ($action === "oui") {
                    $matchQuery = "SELECT * FROM LikeList WHERE IdEnvoi = $profileId AND IdRecoi = $userId";
                    $result = mysqli_query($conn, $matchQuery);
                    if (mysqli_num_rows($result) > 0) {
                        // Il y a un match
                        echo "Match";
                    }
                }
                // Mettre à jour le nombre de likes de l'utilisateur
                if ($forfait === "free") {
                    $nombreVu++;
                    $updateQuery = "UPDATE Utilisateurs SET NombreVu = $nombreVu WHERE id = $userId";
                    mysqli_query($conn, $updateQuery);
                }
            } else {
                echo "Erreur lors de la mise à jour des likes : " . mysqli_error($conn);
            }
        }
    }

    // Fermer la connexion à la base de données
    mysqli_close($conn);
} else {
    // Redirection vers la page d'accueil si les données POST ne sont pas définies
    header("Location: index.php");
    exit();
}
