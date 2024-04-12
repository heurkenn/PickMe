<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: InsCon.php");
    exit();
}

$userId = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['profileId']) && isset($_POST['action'])) {
    $profileId = $_POST['profileId'];
    $action = $_POST['action'];

    $servername = "localhost";
    $username = "ProjetR";
    $password = "Paulympe742@";
    $dbname = "InfoUser";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

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
            echo "Limite atteinte";

        } else {
            $query = "INSERT INTO LikeList (IdEnvoi, IdRecoi, Etat) VALUES ('$userId', '$profileId', '$action')";
            if (mysqli_query($conn, $query)) {
                if ($action === "oui") {
                    $matchQuery = "SELECT * FROM LikeList WHERE IdEnvoi = $profileId AND IdRecoi = $userId";
                    $result = mysqli_query($conn, $matchQuery);
                    if (mysqli_num_rows($result) > 0) {
                        echo "Match";
                    }
                }
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

    mysqli_close($conn);
} else {
    header("Location: index.php");
    exit();
}
