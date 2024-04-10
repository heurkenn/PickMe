<?php
session_start();

$servername = "localhost";
$username = "ProjetR";
$password = "Paulympe742@";
$dbname = "InfoUser";

// Connexion à la base de données
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!isset($_SESSION['user_id'])) {
    header("Location: InsCon.php");
    exit();
}

// Vérifier si l'utilisateur a le forfait "admin"
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
    <title>Contact - PICK ME !</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>

<body>
    <header>
        <h1><a href="index.php" class="custom-link">PICK ME !</h1>
        <nav>
            <ul>
                <li><a href="apropos.php">À propos</a></li>
                <li><a href="#">Abonnement</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="message.php">Tes matchs</a></li>
            </ul>
        </nav>
    </header>

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
        <h2>Contactez-nous</h2>

        <section id="contact-form">
            <h3>Formulaire de Contact</h3>
            <form action="send_message.php" method="post">
                <label for="name">Nom :</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required>

                <label for="subject">Sujet :</label>
                <input type="text" id="subject" name="subject" required>

                <label for="message">Message :</label>
                <textarea id="message" name="message" required></textarea>

                <button type="submit">Envoyer</button>
            </form>
        </section>

        <section id="direct-contact">
            <h3>Contact Direct</h3>
            <p>Email : contact@pickme.com</p>
            <p>Téléphone : 01 23 45 67 89</p>
            <!-- Ajouter plus d'informations si nécessaire -->
        </section>

        <section id="social-media">
            <h3>Nos Réseaux Sociaux</h3>
            <p>Retrouvez-nous sur :</p>
            <ul>
                <li><a href="#">Facebook</a></li>
                <li><a href="#">Twitter</a></li>
                <li><a href="#">Instagram</a></li>
                <!-- Plus de liens vers les réseaux sociaux si nécessaire -->
            </ul>
        </section>

        <!-- Ajoutez d'autres sections si nécessaire -->
    </div>

    <?php include('footer/footer.php'); ?>
</body>

</html>