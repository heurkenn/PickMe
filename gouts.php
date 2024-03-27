<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Formulaire de préférences</title>
</head>
<body>
    <h2>Formulaire de préférences</h2>
    <form action="traitement_gouts.php" method="post">
        <label for="jeux_video">Jeux vidéo :</label>
        <input type="text" id="jeux_video" name="jeux_video"><br><br>

        <label for="sports">Sports :</label>
        <input type="text" id="sports" name="sports"><br><br>

        <label for="hobbies">Hobbies :</label>
        <input type="text" id="hobbies" name="hobbies"><br><br>

        <label for="recherche">Recherche :</label>
        <input type="text" id="recherche" name="recherche"><br><br>

        <!-- Ajoutez d'autres champs selon les besoins -->

        <input type="submit" value="Soumettre">
    </form>
</body>
</html>
