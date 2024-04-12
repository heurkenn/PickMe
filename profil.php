<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: InsCon.php");
    exit();
}

$userId = $_SESSION['user_id'];

$servername = "localhost";
$username = "ProjetR";
$password = "Paulympe742@";
$dbname = "InfoUser";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("La connexion à la base de données a échoué: " . mysqli_connect_error());
}

$sql = "SELECT * FROM Gouts WHERE UtilisateurId = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $userId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

$sql2 = "SELECT id, Nom, Prenom, DATE_FORMAT(DateNaissance, '%d/%m/%Y') AS DateNaissance_format, Sexe, Pseudonyme, Email, MotDePasse, Forfait FROM Utilisateurs WHERE id = ?";
$stmt2 = mysqli_prepare($conn, $sql2);
mysqli_stmt_bind_param($stmt2, "i", $userId);
mysqli_stmt_execute($stmt2);
$result2 = mysqli_stmt_get_result($stmt2);
$user2 = mysqli_fetch_assoc($result2);





if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['currentPassword']) && isset($_POST['newPassword'])) {
        $currentPassword = $_POST['currentPassword'];
        $newPassword = $_POST['newPassword'];


        $sql3 = "SELECT MotDePasse FROM Utilisateurs WHERE id = '$userId'";

        $result = mysqli_query($conn, $sql3);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $motDePasseHash = $row['MotDePasse'];
            if (password_verify($currentPassword, $motDePasseHash)) {
                $motDePasseHash = password_hash($newPassword, PASSWORD_DEFAULT);
                $query = "UPDATE Utilisateurs SET MotDePasse = ? WHERE id = $userId";
                $stmt1 = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($stmt1, "s", $motDePasseHash);
                mysqli_stmt_execute($stmt1);
                
            } else {

                header("Location: admin.php");
            }
        }

    }
    $nPays = $_POST['pays'];
    $nLangue = $_POST['langue'];
    $nGenre = $_POST['genres'];
    $nStyle = $_POST['styleGameplay'];
    $nRecherche = $_POST['recherche'];
    $nBio = $_POST['biographie'];
    $nPic = $_POST['profilPicture'];

    $sql = "UPDATE Gouts SET Pays = ?, Langue = ?,GenreJeux = ?, StyleGameplay = ?, TypeRecherche = ?, Biographie = ?, ProfilPicture = ? WHERE UtilisateurId = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssssssi", $nPays, $nLangue, $nGenre, $nStyle, $nRecherche, $nBio, $nPic, $userId);
    mysqli_stmt_execute($stmt);
    header("Location: profil.php");
    exit();

}

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
    <?php include ('header/header.php'); ?>


    <div class="main">
        <div class="account-button-container">
            <a href="deconnexion.php" class="account-button">Déconnexion</a>
        </div>
        <h2>Ton profil</h2>
        <div id="infPerso" class="hidden">
            <h3>Tes infos personelles</h3>
            <h4>
                <div class="perso" style="font-weight: bold;">Nom: </div>
            </h4>
            <?php echo $user2['Nom']; ?><br>
            <h4>
                <div class="perso" style="font-weight: bold;">Prénom: </div>
            </h4>
            <?php echo $user2['Prenom']; ?><br>
            <h4>
                <div class="perso" style="font-weight: bold;">Date de naissance: </div>
            </h4>
            <?php echo $user2['DateNaissance_format']; ?><br>
            <h4>
                <div class="perso" style="font-weight: bold;">Sexe: </div>
            </h4>
            <?php echo $user2['Sexe']; ?><br>
            <h4>
                <div class="perso" style="font-weight: bold;">Pseudonyme: </div>
            </h4>
            <?php echo $user2['Pseudonyme']; ?></br>
            <h4>
                <div class="perso" style="font-weight: bold;">Email: </div>
            </h4>
            <?php echo $user2['Email']; ?><br>
            <h4>
                <div class="perso" style="font-weight: bold;">Forfait: </div>
            </h4>
            <?php echo $user2['Forfait']; ?><br>
            <button id="mdpButton">Changer mot de passe</button>
            <div id="changePasswordDiv" class="hidden">
                <h3>Changer de mot de passe</h3>
                <form id="changePasswordForm" method="post"
                    action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <label for="currentPassword">Mot de passe actuel :</label><br><br>
                    <input type="password" id="currentPassword" name="currentPassword"><br><br>
                    <label for="newPassword">Nouveau mot de passe :</label><br><br>
                    <input type="password" id="newPassword" name="newPassword"
                        pattern="(?=.*[A-Z])(?=.*[0-9])(?=.*[^a-zA-Z0-9]).{8,}"
                        title="Le mot de passe doit contenir au moins 8 caractères, une majuscule, un chiffre et un caractère spécial."
                        placeholder="8 caractères, une majuscule, un chiffre et un caractère spécial."><br><br>
                    <button type="submit" id="submitPassword">Valider</button>
                </form>
            </div>

        </div>
        <div id="infGene" class="hidden">
            <section class="buttons_gene">
                <button id="paysButtons">Pays</button>
                <button id="langueButtons">Langue</button>
                <button id="genreButtons">Genre</button>
                <button id="styleButtons">Style</button>
                <button id="rechercheButtons">Recherche</button>
                <button id="biographieButtons">Biographie</button>
                <button id="pictureButtons">PP</button>
            </section>
            <h3>Tes gouts</h3>
            <section class="formsProfil">
                <form id="changeProfil" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div id="paysDiv" class="hidden">
                        <label for="pays">Pays :</label><br><br>
                        <input type="text" id="paysSearch" oninput="filterCountries()"
                            placeholder="Recherche par pays..." value="<?php echo $user['Pays']; ?>"><br><br>
                        <select name="pays" id="pays">
                        </select>
                        <br>
                        <p>Informations enregistrées : <br><br>
                            <?php echo htmlspecialchars($user['Pays']); ?>
                        </p>
                    </div>
            </section>

            <div id="langueDiv" class="hidden">
                <label for="langues">Langue(s) :</label>
                <button type="button" class="langue-btn" onclick="toggleSelection(this,'langue')"
                    data-selected="false">Français</button>
                <button type="button" class="langue-btn" onclick="toggleSelection(this,'langue')"
                    data-selected="false">English</button>
                <button type="button" class="langue-btn" onclick="toggleSelection(this,'langue')"
                    data-selected="false">Español</button>
                <button type="button" class="langue-btn" onclick="toggleSelection(this,'langue')"
                    data-selected="false">Deutsch</button>
                <button type="button" class="langue-btn" onclick="toggleSelection(this,'langue')"
                    data-selected="false">日本語</button>
                <button type="button" class="langue-btn" onclick="toggleSelection(this,'langue')"
                    data-selected="false">簡体字中国語</button>
                <input type="hidden" id="langue" name="langue" value="<?php echo $user['Langue']; ?>">
                <p>Informations enregistrées : <br><br>
                    <?php echo htmlspecialchars($user['Langue']); ?>
                </p>
            </div>
            <div id="genreJeuxDiv" class="hidden">
                <label for="genre">Genre de Jeu :</label>
                <button type="button" class="genres-btn" onclick="toggleSelection(this,'genres')"
                    data-selected="false">Aventure</button>
                <button type="button" class="genres-btn" onclick="toggleSelection(this,'genres')"
                    data-selected="false">Simulation</button>
                <button type="button" class="genres-btn" onclick="toggleSelection(this,'genres')"
                    data-selected="false">RPG</button>
                <button type="button" class="genres-btn" onclick="toggleSelection(this,'genres')"
                    data-selected="false">Puzzle</button>
                <button type="button" class="genres-btn" onclick="toggleSelection(this,'genres')"
                    data-selected="false">Platformers</button>
                <button type="button" class="genres-btn" onclick="toggleSelection(this,'genres')"
                    data-selected="false">Horror</button>

                <input type="hidden" id="genres" name="genres" value="<?php echo $user['GenreJeux']; ?>">
                <p>Informations enregistrées : <br><br>
                    <?php echo htmlspecialchars($user['GenreJeux']); ?>
                </p>
            </div>
            <div id="styleJeuxDiv" class="hidden">
                <label for="styleGameplay">Style de gameplay :</label><br><br>
                <select id="styleGameplay" name="styleGameplay" value="<?php echo $user['StyleGameplay']; ?>">
                    <option value="casual">Casual</option>
                    <option value="funSerious">Fun but Serious</option>
                    <option value="absoluteConcentration">Concentration absolue</option>
                    <option value="proLeague">Pro-league</option>
                </select>
                <p>Informations enregistrées : <br><br>
                    <?php echo htmlspecialchars($user['StyleGameplay']); ?>
                </p>
            </div>
            <div id="rechercheDiv" class="hidden">
                <label for="recherche">Recherche :</label><br><br>
                <select id="recherche" name="recherche" value="<?php echo $user['TypeRecherche']; ?>">
                    <option value="discuter">Gens pour discuter</option>
                    <option value="jouer">Gens pour jouer</option>
                    <option value="lesDeux">Les deux</option>
                    <option value="autres">Autres</option>
                </select>
                <p>Informations enregistrées : <br><br>
                    <?php echo htmlspecialchars($user['TypeRecherche']); ?>
                </p>
            </div>
            <div id="biographieDiv" class="hidden">
                <label for="biographie">Biographie :</label><br><br>
                <textarea id="biographie" name="biographie" rows="4"
                    cols="50"><?php echo $user['Biographie']; ?></textarea><br><br>

            </div>
            <div id="profilPictureDiv" class="hidden">
                <label for="profilPicture">Image de profile:</label></br><br>
                <button type="button" class="profil-btn" onclick="toggleSelection(this,'profil')"
                    data-selected="false"><img src=img/1.png class="img-profil"></button>
                <button type="button" class="profil-btn" onclick="toggleSelection(this,'profil')"
                    data-selected="false"><img src=img/2.png class="img-profil"></button>
                <button type="button" class="profil-btn" onclick="toggleSelection(this,'profil')"
                    data-selected="false"><img src=img/3.png class="img-profil"></button>
                <button type="button" class="profil-btn" onclick="toggleSelection(this,'profil')"
                    data-selected="false"><img src=img/4.png class="img-profil"></button>
                <button type="button" class="profil-btn" onclick="toggleSelection(this,'profil')"
                    data-selected="false"><img src=img/5.png class="img-profil"></button>
                <button type="button" class="profil-btn" onclick="toggleSelection(this,'profil')"
                    data-selected="false"><img src=img/6.png class="img-profil"></button>
                <button type="button" class="profil-btn" onclick="toggleSelection(this,'profil')"
                    data-selected="false"><img src=img/7.png class="img-profil"></button>
                <button type="button" class="profil-btn" onclick="toggleSelection(this,'profil')"
                    data-selected="false"><img src=img/8.png class="img-profil"></button>
                <button type="button" class="profil-btn" onclick="toggleSelection(this,'profil')"
                    data-selected="false"><img src=img/9.png class="img-profil"></button>


                <input type="hidden" id="profilPicture" name="profilPicture"
                    value="<?php echo $user['ProfilPicture']; ?>">
                <p>Informations enregistrées : <br><br>
                    <img src=<?php echo htmlspecialchars($user['ProfilPicture']); ?> class="img-profil">
                </p>
            </div>
            <button type="submit" class="hidden" id="enr">Enregistrer les informations</button>
            </form>
        </div>
        <section class="buttons">
            <button id="persoButtons">infos personnelles</button>
            <button id="geneButtons">Gouts</button>
        </section>
    </div>


    </div>
    <?php include ('footer/footer.php'); ?>
    <script src="js/profil.js"></script>
</body>

</html>