<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: InsCon.php");
    exit();
}

$userId = $_SESSION['user_id'];

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PICK ME !</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>

<body>
    <header>
        <h1><a href="index.php" class="custom-link">PICK ME !</a></h1>
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
        <h1>Ton profil</h1>
        <div id="infPerso" class="info">
            <h3>Tes infos personelles</h3>
        </div>
        <div id="infGene" class="hidden">
            <h3>Tes gouts</h3>
            <div id="pays">

            </div>
            <div id="langue">

            </div>
            <div id="genreJeux">

            </div>
            <div id="styleJeux">

            </div>
            <div id="recherche">

            </div>
            <div id="biographie">

            </div>
            <div id="profilPicture">

            </div>
        </div>
        <section class="buttons">
            <button id="persoButtons">infos personnelles</button>
            <button id="geneButtons">gouts</button>
        </section>
    </div>


    </div>
    <footer>
        <p>&copy; 2024 Mon Site Web. Tous droits réservés.</p>
    </footer>
    <script src="profil.js"></script>
</body>

</html>