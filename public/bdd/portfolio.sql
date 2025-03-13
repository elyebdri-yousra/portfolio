-- Table des rôles
CREATE TABLE role (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL
);
 
-- Table des utilisateurs
CREATE TABLE utilisateur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    mdp VARCHAR(255) NOT NULL,
    idRole INT,
    CONSTRAINT fk_utilisateur_role FOREIGN KEY (idRole) REFERENCES role(id)
);

-- Table des projets
CREATE TABLE projet (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,  -- Nom projet 
    description TEXT,     -- Description projet
    urlimg VARCHAR(255),
    date DATE,            -- Date de publication 
    dateCrea DATETIME,    -- Date de création projet
    duree INT,            -- Durée 
    idUser INT,           -- Référence à l'utilisateur qui a créé le projet ( c'est un plus )
    pbSl VARCHAR(255),    -- Problèmes Rencontrés et Solutions Apportées
    CONSTRAINT fk_projet_utilisateur FOREIGN KEY (idUser) REFERENCES utilisateur(id)
);

-- Table des commentaires
CREATE TABLE commentaire (
    id INT AUTO_INCREMENT PRIMARY KEY,
    userId INT,           -- Référence à l'utilisateur qui commente
    createdAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    idRep INT,            -- Référence à un commentaire parent (pour les réponses), peut être NULL
    idProjet INT,         -- Référence au projet commenté
    CONSTRAINT fk_commentaire_utilisateur FOREIGN KEY (userId) REFERENCES utilisateur(id),
    CONSTRAINT fk_commentaire_projet FOREIGN KEY (idProjet) REFERENCES projet(id),
    CONSTRAINT fk_commentaire_rep FOREIGN KEY (idRep) REFERENCES commentaire(id)
);

-- Table des logiciels
CREATE TABLE logiciel (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nomLogiciel VARCHAR(255) NOT NULL,
    urlimgL VARCHAR(255)
);

-- Table des logiciels utilisés
CREATE TABLE logicielUse (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idProjet INT,
    idLogiciel INT,
    CONSTRAINT fk_logicielUse_projet FOREIGN KEY (idProjet) REFERENCES projet(id),
    CONSTRAINT fk_logicielUse_logiciel FOREIGN KEY (idLogiciel) REFERENCES logiciel(id)
);

-- Table des images 
CREATE TABLE images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    urlimgL VARCHAR(255)
);