<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PICK ME !</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>

<body>
    <header>
        <h1>Click me!</h1>

    </header>
    <div class="main">
        <h1>
            Très bien, tu vas pouvoir commencer à personnaliser ton profil et ne t'inquiète pas tu pourras le modifier
            plus tard
        </h1>

        <section class="forms">
            <form id="monFormulaire" method="post" action="traitement_gouts.php" onsubmit="return validateForm()">
                <div>
                    <label for="pays">Pays :</label>
                    <input type="text" id="paysSearch" oninput="filterCountries()" placeholder="Recherche par pays...">
                    <select name="pays" id="pays" required>>

                    </select>
                    </br>
                    <button type="button" onclick="etapeSuivante()">Suivant</button>
                </div>

                <div style="display: none;">
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

                    <input type="hidden" id="langue" name="langue" required>
                    </br>
                    <button type="button" onclick="etapePrecedente()">Précédent</button>
                    <button type="button" onclick="etapeSuivante()">Suivant</button>
                </div>
                <div style="display: none;">
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

                    <input type="hidden" id="genres" name="genres" required>
                    </br>
                    <button type="button" onclick="etapePrecedente()">Précédent</button>
                    <button type="button" onclick="etapeSuivante()">Suivant</button>
                </div>
                <div style="display: none;">
                    <label for="styleGameplay">Style de gameplay :</label>
                    <select id="styleGameplay" name="styleGameplay" required>
                        <option value="casual">Casual</option>
                        <option value="funSerious">Fun but Serious</option>
                        <option value="absoluteConcentration">Concentration absolue</option>
                        <option value="proLeague">Pro-league</option>
                    </select>
                    </br>
                    <button type="button" onclick="etapePrecedente()">Précédent</button>
                    <button type="button" onclick="etapeSuivante()">Suivant</button>
                </div>
                <div style="display: none;">
                    <label for="recherche">Recherche :</label>
                    <select id="recherche" name="recherche" required>
                        <option value="discuter">Gens pour discuter</option>
                        <option value="jouer">Gens pour jouer</option>
                        <option value="lesDeux">Les deux</option>
                        <option value="autres">Autres</option>
                    </select>
                    </br>
                    <button type="button" onclick="etapePrecedente()">Précédent</button>
                    <button type="button" onclick="etapeSuivante()">Suivant</button>

                </div>
                <div style="display: none;">
                    <label for="biographie">Biographie :</label>
                    <textarea id="biographie" name="biographie" rows="4" cols="50"></textarea>
                    </br>
                    <button type="button" onclick="etapePrecedente()">Précédent</button>
                    <button type="button" onclick="etapeSuivante()">Suivant</button>


                </div>
                <div style="display: none;">
                    <label for="profilPicture">Image de profile:</label></br>
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

                    </br>
                    <input type="hidden" id="profilPicture" name="profilPicture" required>
                    <button type="button" onclick="etapePrecedente()">Précédent</button>
                    <button type="submit">Soumettre</button>
                </div>
            </form>
        </section>

    </div>
    <footer>
        <p>&copy; 2024 Mon Site Web. Tous droits réservés.</p>
    </footer>
    <script src="gouts.js"></script>
</body>

</html>