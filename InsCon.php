<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PICK ME !</title>
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="stylesheet" href="footer/footer.css">
</head>

<body>
    <header>
        <h1><a href="InsCon.php" class="custom-link">PICK ME !</a></h1>
    </header>
    <div class="main">
        <section class="forms">
            <div id="inscriptionForm" class="hidden">
                <h2>Formulaire d'inscription</h2>
                <form method="post" action="inscription.php">
                    <label for="Nom">Nom :</label><br><br>
                    <input type="text" id="Nom" name="Nom" required><br>
                    <label for="Prenom">Prenom :</label><br><br>
                    <input type="text" id="Prenom" name="Prenom" required><br>
                    <label for="DateNaissance">Date de naissance :</label><br><br>
                    <input type="date" id="DateNaissance" name="DateNaissance"><br>
                    <label for="Sexe">Sexe :</label><br><br>
                    <select id="Sexe" name="Sexe" required>
                        <option value="homme">Homme</option>
                        <option value="femme">Femme</option>
                        <option value="autre">Autre</option>
                        <option value="charDeGuerre">Char de Guerre</option>
                    </select><br>
                    <label for="Pseudonyme">Pseudonyme :</label><br><br>
                    <input type="text" id="Pseudonyme" name="Pseudonyme" required><br>
                    <label for="Email">Email :</label><br><br>
                    <input type="email" id="Email" name="Email" required><br>
                    <label for="MotDePasse">Mot de passe :</label><br><br>
                    <input type="password" id="MotDePasse" name="MotDePasse"
                        pattern="(?=.*[A-Z])(?=.*[0-9])(?=.*[^a-zA-Z0-9]).{8,}"
                        title="Le mot de passe doit contenir au moins 8 caractères, une majuscule, un chiffre et un caractère spécial."
                        placeholder="8 caractères, une majuscule, un chiffre et un caractère spécial." required><br>
                    <input type="submit" value="Envoyer">
                </form>
            </div>

            <div id="connexionForm" class="hidden">
                <h2>Formulaire de connexion</h2>
                <form method="post" action="connexion.php">
                    <label for="PseudonymeConnexion">Pseudonyme :</label><br><br>
                    <input type="text" id="PseudonymeConnexion" name="Pseudonyme" required><br>
                    <label for="MotDePasse">Mot de passe :</label><br><br>
                    <input type="password" id="MotDePasse" name="MotDePasse" required><br>
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
                <img src="img/start1.jpg" alt="Image 1">
            </div>
            <div id="imgs2" class="image-container">
                <img src="img/continue.jpg" alt="Image 2">
            </div>
        </section>

    </div>
   
    <?php include('footer/footer.php'); ?>
    <script src="js/InsCon.js"></script>
</body>

</html>