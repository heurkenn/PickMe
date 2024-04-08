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
        <h1>PICK ME !</h1>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="apropos.php">À propos</a></li>
                <li><a href="#">Abonnement</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main class="main-content">
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
    </main>

    <footer>
        <p>&copy; 2024 PICK ME ! Tous droits réservés.</p>
    </footer>
</body>
</html>
