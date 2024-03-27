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
        <section class="forms">
            <!-- Formulaire d'inscription -->
            <div id="inscriptionForm" class="hidden">
                <h2>Formulaire d'inscription</h2>
                <form method="post" action="inscription.php"> 
                    <label for="Nom">Nom :</label><br>
                    <input type="text" id="Nom" name="Nom"><br>
                    <label for="Prenom">Prenom :</label><br>
                    <input type="text" id="Prenom" name="Prenom" required><br>
                    <label for="DateNaissance">Date de naissance :</label><br>
                    <input type="date" id="DateNaissance" name="DateNaissance"><br> <!-- Changé pour correspondre au nom de colonne SQL -->
                    <label for="Pseudonyme">Pseudonyme :</label><br>
                    <input type="text" id="Pseudonyme" name="Pseudonyme" required><br>
                    <label for="Email">Email :</label><br>
                    <input type="email" id="Email" name="Email" required><br>
                    <label for="MotdePasse">Mot de passe :</label><br> <!-- Correction du label et du name -->
                    <input type="password" id="MotDePasse" name="MotDePasse" 
                        pattern="(?=.*[A-Z])(?=.*[0-9])(?=.*[^a-zA-Z0-9]).{8,}" 
                        title="Le mot de passe doit contenir au moins 8 caractères, une majuscule, un chiffre et un caractère spécial."
                        required><br>
                    <input type="submit" value="Envoyer">
                </form>
            </div>
            <!-- Formulaire de connexion -->
            <div id="connexionForm" class="hidden">
                <h2>Formulaire de connexion</h2>
                <form method="post" action="connexion.php"> <!-- Notez le changement d'action ici -->
                    <label for="PseudonymeConnexion">Pseudonyme :</label><br>
                    <input type="text" id="PseudonymeConnexion" name="Pseudonyme" required><br> <!-- Correction de l'id pour qu'il soit unique -->
                    <label for="CodeConnexion">Mot de passe :</label><br>
                    <input type="password" id="CodeConnexion" name="Code" required><br> <!-- Correction du name et rend l'id unique -->
                    <input type="submit" value="Envoyer">
                </form>
            </div>
        </section>
        <section class="buttons">
            <button id="inscriptionButton">Commencer l'aventure</button>
            <button id="connexionButton">Reprendre sa partie</button>
        </section>
        <section class="images">
            <div id="imgs1" class="image-container">
                <img src="img/left_choice.png" alt="Image 1">
            </div>
            <div id="imgs2" class="image-container">
                <img src="img/left_choice.png" alt="Image 2">
            </div>
        </section>
    </div>
    <footer>
        <p>&copy; 2024 Mon Site Web. Tous droits réservés.</p>
    </footer>
    <script src="script.js"></script>
</body>
</html>