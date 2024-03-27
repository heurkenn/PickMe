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
    JeuxVideo VARCHAR(100),
    Sports VARCHAR(100),
    Hobbies VARCHAR(100),
    MusiquePreferee VARCHAR(100),
    FilmsPrefers VARCHAR(100),
    LivresPrefers VARCHAR(100),
    RegimeAlimentaire VARCHAR(50),
    HabitudesDeVie VARCHAR(100),
    DomainesInteret VARCHAR(100),
    ValeursPersonnelles VARCHAR(100),
    OpinionsPolitiques VARCHAR(100),
    ActivitesSociales VARCHAR(100),
    ObjectifsAspirations VARCHAR(255),
    FOREIGN KEY (UtilisateurId) REFERENCES Utilisateurs(id)
);


