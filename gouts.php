<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Site Web</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>

<body>
    <header>
        <h1>Click me!</h1>
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
        <h1>
            Très bien, tu vas pouvoir commencer à personnaliser ton profil et ne t'inquiète pas tu pourras le modifier
            plus tard
        </h1>

        <section class="forms">
            <form id="monFormulaire" method="post" action="traitement_gouts.php">
                <div id="etape1">

                    <button type="button" class="genre-btn" onclick="toggleSelection(this)"
                        data-selected="false">Aventure</button>
                    <button type="button" class="genre-btn" onclick="toggleSelection(this)"
                        data-selected="false">Simulation</button>
                    <button type="button" class="genre-btn" onclick="toggleSelection(this)"
                        data-selected="false">RPG</button>
                    <button type="button" class="genre-btn" onclick="toggleSelection(this)"
                        data-selected="false">Puzzle</button>
                    <button type="button" class="genre-btn" onclick="toggleSelection(this)"
                        data-selected="false">Platformers</button>
                    <button type="button" class="genre-btn" onclick="toggleSelection(this)"
                        data-selected="false">Horror</button>

                    <input type="hidden" id="genres" name="genres">
                    <button type="button" onclick="etapeSuivante()">Suivant</button>
                </div>
                <div id="etape2" style="display: none;">
                    <label for="styleGameplay">Style de gameplay :</label>
                    <select id="styleGameplay" name="styleGameplay">
                        <option value="casual">Casual</option>
                        <option value="funSerious">Fun but Serious</option>
                        <option value="absoluteConcentration">Concentration absolue</option>
                        <option value="proLeague">Pro-league</option>
                    </select>
                    <button type="button" onclick="etapePrecedente()">Précédent</button>
                    <button type="button" onclick="etapeSuivante()">Suivant</button>
                </div>
                <div id="etape3" style="display: none;">
                    <label for="recherche">Recherche :</label>
                    <select id="recherche" name="recherche">
                        <option value="discuter">Gens pour discuter</option>
                        <option value="jouer">Gens pour jouer</option>
                        <option value="lesDeux">Les deux</option>
                        <option value="autres">Autres</option>
                    </select>
                    <button type="button" onclick="etapePrecedente()">Précédent</button>
                    <button type="submit">Soumettre</button>
                </div>
            </form>
        </section>

    </div>
    <footer>
        <p>&copy; 2024 Mon Site Web. Tous droits réservés.</p>
    </footer>
    <script src="script.js"></script>
</body>

</html>