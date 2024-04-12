CREATE DATABASE IF NOT EXISTS InfoUser;
USE InfoUser;

DROP TABLE IF EXISTS Gouts;
DROP TABLE IF EXISTS LikeList;
DROP TABLE IF EXISTS Messages;
DROP TABLE IF EXISTS Report;
DROP TABLE IF EXISTS Contact;
DROP TABLE IF EXISTS Utilisateurs;
CREATE TABLE Utilisateurs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    Nom VARCHAR(50) NOT NULL,
    Prenom VARCHAR(50) NOT NULL,
    DateNaissance DATE,
    Sexe VARCHAR(20),
    Pseudonyme VARCHAR(50) NOT NULL UNIQUE, 
    Email VARCHAR(100) NOT NULL UNIQUE, 
    MotDePasse VARCHAR(255) NOT NULL,
    NombreVu INT DEFAULT 0,
    Forfait VARCHAR(20) DEFAULT "free",
    Horaire DATETIME
);

CREATE TABLE Gouts (
    UtilisateurId INT,
    Pays VARCHAR(50),
    Langue VARCHAR(100),
    GenreJeux VARCHAR(100),
    StyleGameplay VARCHAR(100),
    TypeRecherche VARCHAR(100),
    Biographie VARCHAR(500),
    ProfilPicture VARCHAR(100),
    
    FOREIGN KEY (UtilisateurId) REFERENCES Utilisateurs(id)
);

CREATE TABLE LikeList (
    IdEnvoi INT,
    IdRecoi INT,
    Etat VARCHAR(3)

);

CREATE TABLE Messages (
    UtilisateurId INT,
    UtilisateurIdBis INT,
    MessageEnv VARCHAR(500),
    Horaire DATETIME
);

CREATE TABLE Report(
    IdReport INT PRIMARY KEY AUTO_INCREMENT,
    IdSignal INT,
    IdProbleme INT,
    Horaire DATETIME,
    MessageReport VARCHAR(500)
);


CREATE TABLE Contact(
    Id INT PRIMARY KEY AUTO_INCREMENT,
    IdContact INT,
    Sujet VARCHAR(50),
    Horaire DATETIME,
    MessageContact VARCHAR(500)
);