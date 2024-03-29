<?php
// Connexion à la base de données (à remplacer avec vos propres informations)
$servername = "localhost";
$username = "ProjetR";
$password = "Paulympe742@";
$dbname = "maBaseDeDonnees";

// Connexion à la base de données
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connexion établie" . "<br>";

// Récupération des valeurs du formulaire
$genre = $_POST['genres'];
$styleGameplay = $_POST['styleGameplay'];
$recherche = $_POST['recherche'];

// Requête SQL pour insérer les données dans la table Gouts
$query = "INSERT INTO Gouts (UtilisateurId, GenreJeux, StyleGameplay, TypeRecherche)
        VALUES ((SELECT ID FROM Utilisateurs ORDER BY ID DESC LIMIT 1), '$genre', '$styleGameplay', '$recherche')";

echo "Requête SQL: " . $query . "<br>";


$result = mysqli_query($conn, $query);
if (!$result) {
    printf("Erreur: %s\n", mysqli_error($conn));
} else {
    echo 'Données insérées avec succès. <br>';
    // Ajouter le bouton de redirection
    echo '<a href="accueil.php"><button>Retour à l\'accueil</button></a>';
}

// Fermeture de la connexion
mysqli_close($conn);
