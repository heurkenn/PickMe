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
    <link rel="stylesheet" href="contact.css">
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
        <h2>Contactez-nous</h2>

        <section class="forms">
            <h3>Formulaire de Contact</h3>
            <div id="contactForm" >
            <form action="send_message.php" method="post">
                <label for="name">Nom :</label><br><br>
                <input type="text" id="name" name="name" required>

                <label for="email">Email :</label><br><br>
                <input type="email" id="email" name="email" required>

                <label for="subject">Sujet :</label><br><br>
                <input type="text" id="subject" name="subject" required>

                <label for="message">Message :</label><br><br>
                <textarea type="text" id="message" name="message" required></textarea><br><br>

                <input type="submit" value="Envoyer">
            </form>
        </section>

        <section id="direct-contact">
            <h3>Contact Direct</h3>
            <p>Email : contact@pickme.com</p>
            <p>Téléphone : 01 23 45 67 89</p>

        </section>

    </div>

    <?php include('footer/footer.php'); ?>
</body>

</html>