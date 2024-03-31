<?php
// Connexion à la base de données (à remplacer avec vos propres informations)
$servername = "localhost";
$username = "ProjetR";
$password = "Paulympe742@";
$dbname = "InfoUser";

// Connexion à la base de données
session_start();

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['user_id'])) {
    // L'utilisateur est connecté, récupérer son ID
    $userId = $_SESSION['user_id'];

    // Vous pouvez maintenant utiliser $userId dans votre code pour faire référence à l'identifiant de l'utilisateur
    echo "L'identifiant de l'utilisateur connecté est : " . $userId;
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
} else {
    // L'utilisateur n'est pas connecté ou la session a expiré
    echo "Aucun utilisateur connecté.";
}

// Récupération des valeurs du formulaire
$pays = $_POST['pays'];
$langue = $_POST['langue'];
$genre = $_POST['genres'];
$styleGameplay = $_POST['styleGameplay'];
$recherche = $_POST['recherche'];

// Requête SQL pour insérer les données dans la table Gouts
$query = "INSERT INTO Gouts (UtilisateurId, Pays, Langue, GenreJeux, StyleGameplay, TypeRecherche)
        VALUES ('$userId', '$pays', '$langue', '$genre', '$styleGameplay', '$recherche')";


echo "Requête SQL: " . $query . "<br>";


$result = mysqli_query($conn, $query);
if (!$result) {
    printf("Erreur: %s\n", mysqli_error($conn));
} else {
    header("Location: index.php");
    // Ajouter le bouton de redirection
    echo '<a href="accueil.php"><button>Retour à l\'accueil</button></a>';
}

// Fermeture de la connexion
mysqli_close($conn);
