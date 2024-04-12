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
$search_query2 = "";
$search_results = [];

// Traitement de la recherche
if (isset($_GET['search'])) {
    // Récupération des valeurs des critères de recherche
    $search_query = trim($_GET['search_query']);
    $search_query2 = trim($_GET['search_query2']);

    // Requête pour trouver les profils correspondants à la recherche
    $sql = "SELECT *, DATE_FORMAT(DateNaissance, '%d/%m/%Y') AS DateNaissance_format
            FROM Utilisateurs 
            JOIN Gouts ON Utilisateurs.id = Gouts.UtilisateurId
            WHERE Utilisateurs.id <> {$_SESSION['user_id']} AND ";

    // Ajoute les conditions en fonction des valeurs des critères de recherche
    if ($search_query !== 'none' && $search_query2 !== 'none') {
        // Si les deux critères sont sélectionnés
        $sql .= "TypeRecherche LIKE '%$search_query%' AND StyleGameplay LIKE '%$search_query2%'";
    } elseif ($search_query !== 'none') {
        // Si seul le premier critère est sélectionné
        $sql .= "TypeRecherche LIKE '%$search_query%'";
    } elseif ($search_query2 !== 'none') {
        // Si seul le deuxième critère est sélectionné
        $sql .= "StyleGameplay LIKE '%$search_query2%'";
    } elseif ($search_query === 'none' && $search_query2 === 'none') {
        // Si seul le deuxième critère est sélectionné
        $sql .= "1 = 1";
    } else {
        // Si aucun critère n'est sélectionné, ne retourne aucun résultat
        $sql .= "1 = 0";
    }

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
    <?php include ('header/header.php'); ?>
    <div class="main">
        <div class="account-button-container">
            <a href="profil.php" class="account-button">Mon compte</a>
            <a href="deconnexion.php" class="account-button">Déconnexion</a>
        </div>

        <div class="search-container">
            <form action="" method="GET">
                <select id="recherche" name="search_query" required>
                <option value="none">---</option>
                    <option value="discuter">Gens pour discuter</option>
                    <option value="jouer">Gens pour jouer</option>
                    <option value="lesDeux">Les deux</option>
                    <option value="autres">Autres</option>
                </select><br>
                <select id="styleGameplay" name="search_query2" required>
                    <option value="none">---</option>
                    <option value="casual">Casual</option>
                    <option value="funSerious">Fun but Serious</option>
                    <option value="absoluteConcentration">Concentration absolue</option>
                    <option value="proLeague">Pro-league</option>
                </select>
                <button type="submit" onclick="searchProfiles()" name="search" class="gestion-btn">Rechercher</button>
            </form>
        </div>
        <div class="pos">
            <div class="profile-list">
                <?php if (!empty($search_results)): ?>
                    <?php foreach ($search_results as $profile): ?>
                        <div class="profile">
                            <h2>
                                <?php echo htmlspecialchars(' (' . $profile['Pseudonyme'] . ')'); ?>
                                </br>
                                <img src="<?php echo htmlspecialchars($profile['ProfilPicture']); ?>" class="img-profil">
                            </h2>
                            <button class="buttons" onclick='showAdditionalInfo(<?= $profile['id'] ?>)'>Plus d'infos</button>

                            <div id='additional-info-<?= $profile['id'] ?>' class='additional-info hidden'>
                                <h3>
                                    <?= htmlspecialchars($profile['Pseudonyme'], ENT_QUOTES, 'UTF-8') ?>
                                </h3>
                                <p>
                                    <img src=<?php echo htmlspecialchars($profile['ProfilPicture'], ENT_QUOTES, 'UTF-8'); ?>
                                        class="img-profil">
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
        <div id="modal-background" class="modal-background">
            <div class="modal-content">
                <span class="close-btn" onclick="hideAdditionalInfo()">&times;</span>
                <div id="modal-info"></div>
            </div>
        </div>
    </div>
    <?php include ('footer/footer.php'); ?>
    <script src="js/admin.js"></script>
</body>

</html>