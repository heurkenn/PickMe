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

if (!isset($_SESSION['user_id'])) {
    header("Location: InsCon.php");
    exit();
}

$query = "SELECT Forfait FROM Utilisateurs WHERE id = {$_SESSION['user_id']}";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) == 0) {
    header("Location: InsCon.php");
    exit();
}
$row = mysqli_fetch_assoc($result);
$forfait = $row['Forfait'];
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À propos - PICK ME !</title>
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="stylesheet" href="apropos.css">
</head>

<body>
<?php include('header/header.php'); ?>

    <div class="main">
        <div class="account-button-container">
            <a href="profil.php" class="account-button">Mon compte</a>
            <a href="deconnexion.php" class="account-button">Déconnexion</a>
        </div>
        <div class="admin-button-container">
            <?php if ($forfait === 'admin'): ?>
                <a href="admin.php" class="account-button">Admin</a>
            <?php endif; ?>
        </div>
        <section class="apropos">
    <div class="container-propos">
        <h2>Notre Mission</h2>
        <section id="mission">
            <p>Créer des connexions significatives entre joueurs du monde entier. Offrir une plateforme où les
                passionnés de jeux vidéo peuvent se rencontrer, échanger, et partager.</p>
        </section>

        <section id="pourquoi-nomdusite">
            <h2>Pourquoi "Pick Me !" ?</h2>
            <p>L'accent mis sur les communautés de jeux vidéo et la manière dont notre plateforme favorise des
                rencontres basées sur des intérêts communs.</p>
        </section>

        <section id="fonctionnement">
            <h2>Comment ça marche ?</h2>
            <p>Inscrivez-vous et remplissez votre profil avec vos jeux préférés, genres favoris, et plateformes de jeu.
                Notre système de matching unique vous connecte avec des joueurs ayant des goûts similaires.</p>
        </section>

        <section id="securite">
            <h2>Sécurité et Vie Privée</h2>
            <p>Les mesures prises pour protéger les données personnelles et la vie privée des utilisateurs.</p>
        </section>

        <section id="equipe">
            <h2>Rencontrez l'équipe</h2>
            <p>Rencontrez nos passionnés de jeux vidéo qui ont créé "Pick Me !".</p>
        </section>

        <section id="contact">
            <h2>Contactez-nous</h2>
            <p>Pour du support, des partenariats, ou des questions générales, n'hésitez pas à nous contacter à <a href="mailto:contact@pickme.com">contact@pickme.com</a>.</p>
        </section>

        <section id="temoignages">
            <h2>Témoignages</h2>
            <p>"Ce site a changé ma façon de rencontrer des gens avec qui jouer. Je ne me suis jamais autant
                amusé!"</p>
        </section>

        <section id="faq">
            <h2>FAQ</h2>
            <p>Retrouvez ici les réponses aux questions les plus fréquentes.</p>
        </section>
    </div>
</section>

        
    </div>
    

    <?php include('footer/footer.php'); ?>
    <script src="js/index.js"></script>
</body>

</html>