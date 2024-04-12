<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: InsCon.php");
    exit();
}

$userId = $_SESSION['user_id'];

if(isset($_POST["message_id"])) {
    $msgId = $_POST["message_id"];

    $servername = "localhost";
    $username = "ProjetR";
    $password = "Paulympe742@";
    $dbname = "InfoUser";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "SELECT UtilisateurId FROM Messages WHERE IdMessage = $msgId";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $messageUserId = $row['UtilisateurId'];
        
        if ($messageUserId == $userId) {
            $deleteQuery = "DELETE FROM Messages WHERE IdMessage = $msgId";
            mysqli_query($conn, $deleteQuery);
        }
    }
    
    mysqli_close($conn);
}


