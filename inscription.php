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
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$nom = $_POST['Nom'];
$prenom = $_POST['Prenom'];
$dateNaissance = $_POST['DateNaissance'];
$sexe = $_POST['Sexe'];
$pseudonyme = $_POST['Pseudonyme'];
$email = $_POST['Email'];
$motDePasse = $_POST['MotDePasse'];

$motDePasseHash = password_hash($motDePasse, PASSWORD_DEFAULT);

$query = "INSERT INTO Utilisateurs (Nom, Prenom, DateNaissance, Sexe, Pseudonyme, Email, MotDePasse, Horaire)
        VALUES ('$nom', '$prenom', '$dateNaissance', '$sexe', '$pseudonyme', '$email', '$motDePasseHash', NOW())";


$result = mysqli_query($conn, $query);

if ($result) {

    $_SESSION['user_id'] = mysqli_insert_id($conn);
    header("Location: gouts.php");
    exit();
} else {
    echo "Une erreur est survenue. Veuillez réessayer.";
    echo '<script>setTimeout(function() { window.location.href = "InsCon.php"; }, 3000);</script>';
}

mysqli_close($conn);
