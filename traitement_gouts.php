<?php
session_start();

$servername = "localhost";
$username = "ProjetR";
$password = "Paulympe742@";
$dbname = "InfoUser";



// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['user_id'])) {
    
    $userId = $_SESSION['user_id'];
    echo "L'identifiant de l'utilisateur connecté est : " . $userId;
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
} else {
    echo "Aucun utilisateur connecté.";
}


$pays = $_POST['pays'];
$langue = $_POST['langue'];
$genre = $_POST['genres'];
$styleGameplay = $_POST['styleGameplay'];
$recherche = $_POST['recherche'];
$biographie = $_POST['biographie'];
$profilPic = $_POST['profilPicture'];


$query = "INSERT INTO Gouts (UtilisateurId, Pays, Langue, GenreJeux, StyleGameplay, TypeRecherche, Biographie,ProfilPicture)
        VALUES ('$userId', '$pays', '$langue', '$genre', '$styleGameplay', '$recherche', '$biographie','$profilPic')";

$query2= "INSERT INTO LikeList (UtilisateurId)
        VALUES ('$userId')";


echo "Requête SQL: " . $query . "<br>";


$result = mysqli_query($conn, $query);
$result2 = mysqli_query($conn, $query2);

if (!$result) {
    printf("Erreur: %s\n", mysqli_error($conn));
} else {
    $_SESSION['gouts_enregistres'] = true;
    header("Location: index.php");
}

// Fermeture de la connexion
mysqli_close($conn);
