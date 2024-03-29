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


// Informations statiques à insérer
$nom = $_POST['Nom'];
$prenom = $_POST['Prenom'];
$dateNaissance = $_POST['DateNaissance'];
$pseudonyme = $_POST['Pseudonyme'];
$email = $_POST['Email'];
$motDePasse = $_POST['MotDePasse'];

// Hachage du mot de passe
$motDePasseHache = password_hash($motDePasse, PASSWORD_DEFAULT);


// Requête SQL pour insérer les données statiques dans la table appropriée
$query = "INSERT INTO Utilisateurs (Nom, Prenom, DateNaissance, Pseudonyme, Email, MotDePasse)
        VALUES ('$nom', '$prenom', '$dateNaissance', '$pseudonyme', '$email', '$motDePasseHache')";

$result = mysqli_query($conn, $query);



// Fermeture de la connexion
mysqli_close($conn); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Site Web</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>

<body>
    <header>
        <h1>Click me!</h1>
        <nav>
            <ul>
                <li><a href="#">Accueil</a></li>
                <li><a href="#">À propos</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>
    <div class="main">
        <h1>
            Très bien, tu vas pouvoir commencer à personnaliser ton profil et ne t'inquiète pas tu pourras le modifier
            plus tard
        </h1>

        <section class="forms" >
            <form id="monFormulaire" method="post" action="traitement_gouts.php">
                <div id="etape1">
                    <label for="genre">Genre de jeu :</label>
                    <select id="genre" name="genre">
                        <option value="aventure">Aventure</option>
                        <option value="fps">FPS</option>
                        <option value="simulation">Simulation</option>
                        <option value="rpg">RPG</option>
                        <option value="puzzle">Puzzle</option>
                        <option value="platformers">Platformers</option>
                        <option value="horror">Horror</option>
                    </select>
                    <button type="button" onclick="etapeSuivante()">Suivant</button>
                </div>
                <div id="etape2" style="display: none;">
                    <label for="styleGameplay">Style de gameplay :</label>
                    <select id="styleGameplay" name="styleGameplay">
                        <option value="casual">Casual</option>
                        <option value="funSerious">Fun but Serious</option>
                        <option value="absoluteConcentration">Concentration absolue</option>
                        <option value="proLeague">Pro-league</option>
                    </select>
                    <button type="button" onclick="etapePrecedente()">Précédent</button>
                    <button type="button" onclick="etapeSuivante()">Suivant</button>
                </div>
                <div id="etape3" style="display: none;">
                    <label for="recherche">Recherche :</label>
                    <select id="recherche" name="recherche">
                        <option value="discuter">Gens pour discuter</option>
                        <option value="jouer">Gens pour jouer</option>
                        <option value="lesDeux">Les deux</option>
                        <option value="autres">Autres</option>
                    </select>
                    <button type="button" onclick="etapePrecedente()">Précédent</button>
                    <button type="submit">Soumettre</button>
                </div>
            </form>
        </section>

    </div>
    <footer>
        <p>&copy; 2024 Mon Site Web. Tous droits réservés.</p>
    </footer>
    <script src="script.js"></script>
</body>

</html>