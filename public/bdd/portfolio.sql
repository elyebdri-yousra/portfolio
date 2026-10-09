CREATE DATABASE portfolio;
USE portfolio;


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
    titre VARCHAR(700) NOT NULL,  -- Nom projet 
    description TEXT,     -- Description projet
    date DATE,            -- Date de publication 
    dateCrea INT(4),    -- Date de création projet 
    apprentissageCritique TEXT,
    competenceAssociee VARCHAR(255),
    typeProjet VARCHAR(255),
    argumentaire TEXT,
    idUser INT,           -- Référence à l'utilisateur qui a créé le projet ( c'est un plus )
    CONSTRAINT fk_projet_utilisateur FOREIGN KEY (idUser) REFERENCES utilisateur(id)
);

-- Table pour enregistrer les images
CREATE TABLE projet_img(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    img_path VARCHAR(255) NOT NULL,
    id_projet INT NOT NULL,
    CONSTRAINT fk_image_projet FOREIGN KEY (id_projet) REFERENCES projet(id) ON DELETE CASCADE

);

-- Table des commentaires
CREATE TABLE commentaire (
    id INT AUTO_INCREMENT PRIMARY KEY,
    userId INT,           -- Référence à l'utilisateur qui commente
    createdAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    idProjet INT,         -- Référence au projet commenté
    commentaire TEXT,
    CONSTRAINT fk_commentaire_utilisateur FOREIGN KEY (userId) REFERENCES utilisateur(id) ON DELETE CASCADE,
    CONSTRAINT fk_commentaire_projet FOREIGN KEY (idProjet) REFERENCES projet(id) ON DELETE CASCADE
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
    url_img VARCHAR(255),
    idLogiciel INT,
    CONSTRAINT fk_logicielUse_projet FOREIGN KEY (idProjet) REFERENCES projet(id) ON DELETE CASCADE,
    CONSTRAINT fk_logicielUse_logiciel FOREIGN KEY (idLogiciel) REFERENCES logiciel(id)
);

-- Table des images 
CREATE TABLE images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    urlimgL VARCHAR(255)
);


CREATE TABLE competences(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom varchar(255) NOT NULL
);

CREATE TABLE projet_competence(
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_projet INT,
    id_competence INT,
    CONSTRAINT fk_projectUse_competence FOREIGN KEY (id_projet) REFERENCES projet(id) ON DELETE CASCADE,
    CONSTRAINT fk_competenceUse_competence FOREIGN KEY (id_competence) REFERENCES competences(id)
);



INSERT INTO competences(nom) VALUES('Développer');
INSERT INTO competences(nom) VALUES('Concevoir');
INSERT INTO competences(nom) VALUES('Entreprendre');
INSERT INTO competences(nom) VALUES('Comprendre');
INSERT INTO competences(nom) VALUES('Exprimer');



INSERT INTO role(nom) VALUES ('Administrateur');
INSERT INTO role(nom) VALUES ('Evaluateur');
INSERT INTO role(nom) VALUES ('En attente');
INSERT INTO role(nom) VALUES ('Refusé');