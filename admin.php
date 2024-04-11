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

// Vérifie si l'utilisateur est connecté et a un forfait "admin"
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$query = "SELECT Forfait FROM Utilisateurs WHERE id = {$_SESSION['user_id']}";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) == 0) {
    header("Location: index.php");
    exit();
}

// Initialisation des variables de recherche
$search_query = "";
$search_results = [];

// Traitement de la recherche
if (isset($_GET['search'])) {
    // Récupération de la valeur de recherche
    $search_query = trim($_GET['search_query']);

    // Requête pour trouver les profils correspondants à la recherche
    $sql = "SELECT * 
    FROM Utilisateurs 
    JOIN Gouts ON Utilisateurs.id = Gouts.UtilisateurId
    WHERE nom LIKE '%$search_query%' OR prenom LIKE '%$search_query%' OR pseudonyme LIKE '%$search_query%' OR id = '$search_query'";

    $result = mysqli_query($conn, $sql);

    // Vérification s'il y a des résultats
    if (mysqli_num_rows($result) > 0) {
        // Récupération des résultats dans un tableau
        while ($row = mysqli_fetch_assoc($result)) {
            $search_results[] = $row;
        }
    } else {
        // Aucun résultat trouvé
        $search_results = [];
    }
}

if (isset($_POST['action']) && $_POST['action'] === 'delete') {
    $profile_id = $_POST['profile_id'];
    // Suppression du profil de la base de données
    $sql_key0 = "SET FOREIGN_KEY_CHECKS = 0";
    $result_key0 = mysqli_query($conn, $sql_key0);
    $sql_delete_user = "DELETE FROM Utilisateurs WHERE id = $profile_id";
    $result1 = mysqli_query($conn, $sql_delete_user);
    $sql_delete_gout = "DELETE FROM Gouts WHERE UtilisateurId = $profile_id";
    $result2 = mysqli_query($conn, $sql_delete_gout);
    $sql_delete_like = "DELETE FROM LikeList WHERE IdEnvoi = $profile_id OR IdRecoi = $profile_id";
    $result3 = mysqli_query($conn, $sql_delete_like);
    $sql_delete_msg = "DELETE FROM Messages WHERE UtilisateurId = $profile_id OR UtilisateurIdBis = $profile_id";
    $result4 = mysqli_query($conn, $sql_delete_msg);
    $sql_delete_rpt = "DELETE FROM Report WHERE IdSignal = $profile_id OR IdProbleme = $profile_id";
    $result5 = mysqli_query($conn, $sql_delete_msg);
    $sql_key1 = "SET FOREIGN_KEY_CHECKS = 1";
    $result_key1 = mysqli_query($conn, $sql_key1);
    header("Location: admin.php");
    exit();

}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupère l'ID de l'utilisateur à partir du formulaire
    $userId = $_POST['user_id'];
    // Récupère les données du formulaire
    $nPseudo = $_POST['pseudo'];
    var_dump($nPseudo);
    $nBio = $_POST['biographie'];
    var_dump($nBio);

    // Met à jour les informations de l'utilisateur dans la base de données
    $sql = "UPDATE Utilisateurs SET Pseudonyme = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "si", $nPseudo, $userId);
    mysqli_stmt_execute($stmt);

    $sql = "UPDATE Gouts SET Biographie = ? WHERE UtilisateurId = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "si", $nBio, $userId);
    mysqli_stmt_execute($stmt);

    // Redirige l'utilisateur vers la page de profil après la mise à jour
    header("Location: admin.php");
    exit();
}
// Vérifie si le formulaire a été soumis pour mettre à jour les informations de l'utilisateur



?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pick Me !</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>

<body>
    <header>
        <h1><a href="index.php" class="custom-link">Pick Me !</a></h1>
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

        <div class="search-container">
            <form action="" method="GET">
                <input type="text" name="search_query" id="search_query"
                    placeholder="Rechercher par nom, prénom, pseudonyme ou ID" class="search-input" value="">
                <button type="submit" onclick="searchProfiles()" name="search" class="gestion-btn">Rechercher</button>
            </form>
        </div>
        <div class="pos">
            <div class="profile-list">
                <?php if (!empty($search_results)): ?>
                    <?php foreach ($search_results as $profile): ?>
                        <div class="profile">
                            <h2>
                                <?php echo htmlspecialchars($profile['Prenom'] . ' ' . $profile['Nom'] . ' (' . $profile['Pseudonyme'] . ')' . ' #' . $profile['id']); ?>
                                </br>
                                <img src="<?php echo htmlspecialchars($profile['ProfilPicture']); ?>" class="img-profil">
                            </h2>
                            <form action="" method="POST">
                                <input type="hidden" name="profile_id" value="<?php echo $profile['id']; ?>">
                                <button type="submit" class="buttons" name="action" value="delete">Supprimer</button>

                                <button type="button" class="buttons" name="action"
                                    onclick="showModifier(<?php echo $profile['id']; ?>)">Modifier</button>

                            </form>
                            <button class="buttons" onclick='showAdditionalInfo(<?= $profile['id'] ?>)'>Plus d'infos</button>
                            <button class="buttons" onclick="showMessages(<?php echo $profile['id']; ?>)">Messages</button>
                            <div id="modif-container-<?php echo $profile['id']; ?>" class="hidden">
                                <section class="buttons_gene">
                                    <button id="pseudo"
                                        onclick="pseudoMofifier(<?php echo $profile['id']; ?>)">Pseudonyme</button>
                                    <button id="bio" onclick="bioMofifier(<?php echo $profile['id']; ?>)">Biographie</button>
                                </section>
                                <form id="modifAdmin" method="POST" action="">
                                    <div id="pseudoDiv-<?php echo $profile['id']; ?>" class="hidden">
                                        <label for="pseudo">Pseudonyme :</label>
                                        <input type="text" id="pseudo-input" name="pseudo" placeholder="Pseudo"
                                            value="<?php echo $profile['Pseudonyme']; ?>">

                                        <br>
                                        <p>Informations enregistrées:
                                            <?php echo htmlspecialchars($profile['Pseudonyme']); ?>
                                        </p>
                                    </div>
                                    <div id="biographieDiv-<?php echo $profile['id']; ?>" class="hidden">
                                        <label for="biographie">Biographie :</label>
                                        <textarea id="biographie" name="biographie" rows="4"
                                            cols="50"><?php echo $profile['Biographie']; ?></textarea>

                                    </div>
                                    <input type="hidden" name="user_id" value="<?php echo $profile['id']; ?>">
                                    <button type="submit">Enregistrer les informations</button>
                                </form>
                            </div>
                            <div id='additional-info-<?= $profile['id'] ?>' class='additional-info hidden'>
                                <h3>
                                    <?= htmlspecialchars($profile['Pseudonyme'], ENT_QUOTES, 'UTF-8') ?>
                                </h3>
                                <p>
                                    <img src=<?php echo htmlspecialchars($profile['ProfilPicture'], ENT_QUOTES, 'UTF-8'); ?>
                                        class="img-profil">
                                </p>
                                <p>Prénom:
                                    <?= htmlspecialchars($profile['Prenom'], ENT_QUOTES, 'UTF-8') ?>
                                </p>
                                <p>Nom:
                                    <?= htmlspecialchars($profile['Nom'], ENT_QUOTES, 'UTF-8') ?>
                                </p>
                                <p>Date de Naissance:
                                    <?= htmlspecialchars($profile['DateNaissance'], ENT_QUOTES, 'UTF-8') ?>
                                </p>
                                <p>Email:
                                    <?= htmlspecialchars($profile['Email'], ENT_QUOTES, 'UTF-8') ?>
                                </p>
                                <p>Forfait:
                                    <?= htmlspecialchars($profile['Forfait'], ENT_QUOTES, 'UTF-8') ?>
                                </p>
                                </br>

                                <p>Pays:
                                    <?= htmlspecialchars($profile['Pays'], ENT_QUOTES, 'UTF-8') ?>
                                </p>
                                <p>Langue:
                                    <?= htmlspecialchars($profile['Langue'], ENT_QUOTES, 'UTF-8') ?>
                                </p>
                                <p>Genre de jeux:
                                    <?= htmlspecialchars($profile['GenreJeux'], ENT_QUOTES, 'UTF-8') ?>
                                </p>
                                <p>Style de gameplay:
                                    <?= htmlspecialchars($profile['StyleGameplay'], ENT_QUOTES, 'UTF-8') ?>
                                </p>
                                <p>Recherche:
                                    <?= htmlspecialchars($profile['TypeRecherche'], ENT_QUOTES, 'UTF-8') ?>
                                </p>
                                <p>Biographie:
                                    <?= htmlspecialchars($profile['Biographie'], ENT_QUOTES, 'UTF-8') ?>
                                </p>

                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php elseif (isset($_GET['search'])): ?>
                    <p>Aucun résultat trouvé pour "
                        <?php echo htmlspecialchars($search_query); ?>"
                    </p>
                <?php endif; ?>
            </div>
        </div>

    </div>
    <?php include('footer/footer.php'); ?>
    <script src="admin.js"></script>
</body>

</html>