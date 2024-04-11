<header class="header">
    <h1><a href="index.php" class="custom-link">PICK ME !</h1>
    <nav>
        <ul>
            <li><a href="apropos.php">À propos</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="abonnement.php">Abonnement</a></li>
            <li><?php if ($forfait != 'free'): ?>
                    <a href="message.php">Tes matchs</a>
                <?php endif; ?>
            </li>
            <li><?php if ($forfait === 'free'): ?>
                    <a href="match.php">Tes Matchs</a>
                <?php endif; ?>
            </li>
        </ul>
    </nav>
</header>