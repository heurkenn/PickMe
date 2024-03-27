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

// Informations statiques à insérer
$nom = $_POST['Nom'];
$prenom = $_POST['Prenom'];
$dateNaissance = $_POST['DateNaissance']; 
$pseudonyme = $_POST['Pseudonyme'];
$email = $_POST['Email'];
$motDePasse = $_POST['MotDePasse'];

// Hachage du mot de passe
$motDePasseHache = password_hash($motDePasse, PASSWORD_DEFAULT);

echo "test" . "<br>";
// Requête SQL pour insérer les données statiques dans la table appropriée
$query = "INSERT INTO Utilisateurs (Nom, Prenom, DateNaissance, Pseudonyme, Email, MotDePasse)
        VALUES ('$nom', '$prenom', '$dateNaissance', '$pseudonyme', '$email', '$motDePasseHache')";
echo "test2" . "<br>";
echo "Requête SQL: " . $query . "<br>";
$result = mysqli_query($conn, $query);
if (!$result) {
    printf("Erreur: %s\n", mysqli_error($conn));
} else {
    echo 'Données insérées avec succès.';
}

echo "test3" . "<br>";
// Fermeture de la connexion
mysqli_close($conn);

