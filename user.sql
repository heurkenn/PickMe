CREATE DATABASE IF NOT EXISTS maBaseDeDonnees;
USE maBaseDeDonnees;

DROP TABLE IF EXISTS Gouts;
DROP TABLE IF EXISTS Utilisateurs;
CREATE TABLE Utilisateurs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    Nom VARCHAR(50) NOT NULL,
    Prenom VARCHAR(50) NOT NULL,
    DateNaissance DATE, 
    Pseudonyme VARCHAR(50) NOT NULL UNIQUE, 
    Email VARCHAR(100) NOT NULL UNIQUE, 
    MotDePasse VARCHAR(255) NOT NULL 
);

CREATE TABLE Gouts (
    UtilisateurId INT,
    GenreJeux VARCHAR(100),
    StyleGameplay VARCHAR(100),
    TypeRecherche VARCHAR(100),
    
    FOREIGN KEY (UtilisateurId) REFERENCES Utilisateurs(id)
);


