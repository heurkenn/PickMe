CREATE DATABASE IF NOT EXISTS InfoUser;
USE InfoUser;

DROP TABLE IF EXISTS Gouts;
DROP TABLE IF EXISTS Utilisateurs;
CREATE TABLE Utilisateurs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    Nom VARCHAR(50) NOT NULL,
    Prenom VARCHAR(50) NOT NULL,
    DateNaissance DATE, 
    Pseudonyme VARCHAR(50) NOT NULL UNIQUE, 
    Email VARCHAR(100) NOT NULL UNIQUE, 
    MotDePasse VARCHAR(255) NOT NULL,
    Forfait VARCHAR(20) DEFAULT "free"
);

CREATE TABLE Gouts (
    UtilisateurId INT,
    Pays VARCHAR(50),
    Langue VARCHAR(100),
    GenreJeux VARCHAR(100),
    StyleGameplay VARCHAR(100),
    TypeRecherche VARCHAR(100),
    
    FOREIGN KEY (UtilisateurId) REFERENCES Utilisateurs(id)
);


