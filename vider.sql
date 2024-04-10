-- Désactiver les contraintes de clé étrangère
SET FOREIGN_KEY_CHECKS = 0;

-- Tronquer les tables dans un ordre qui évite les erreurs de clé étrangère
TRUNCATE TABLE Utilisateurs;
TRUNCATE TABLE Gouts;
TRUNCATE TABLE LikeList;
TRUNCATE TABLE Messages;
-- Ajoutez ici d'autres tables si nécessaire

-- Réactiver les contraintes de clé étrangère
SET FOREIGN_KEY_CHECKS = 1;
