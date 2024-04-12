<?php
session_start();

$servername = "localhost";
$username = "ProjetR";
$password = "Paulympe742@";
$dbname = "InfoUser";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connexion établie" . "<br>";

$pseudonyme = mysqli_real_escape_string($conn, $_POST['Pseudonyme']);
$motDePasse = mysqli_real_escape_string($conn, $_POST['MotDePasse']);

$sql = "SELECT id, MotDePasse FROM Utilisateurs WHERE Pseudonyme = '$pseudonyme'";

$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $motDePasseHash = $row['MotDePasse'];
    if (password_verify($motDePasse, $motDePasseHash)) {
        $_SESSION['user_id'] = $row['id'];
        $userId = $_SESSION['user_id'];
        $sqlGouts = "SELECT * FROM Gouts WHERE UtilisateurId = '$userId'";
        $resultGouts = mysqli_query($conn, $sqlGouts);

        if (!($resultGouts->num_rows > 0)) {

            header("Location: gouts.php");
            exit();
        }
        header("Location: index.php");
        exit();
    } else {

        header("Location: InsCon.php");
    }
} else {
    echo "Utilisateur non trouvé";
}

$conn->close();

