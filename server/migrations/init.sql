-- Rôles
CREATE TABLE roles (
  id SERIAL PRIMARY KEY,
  nom VARCHAR(255) NOT NULL UNIQUE
);

INSERT INTO roles (nom) VALUES ('admin'), ('evaluateur'), ('attente'), ('refuse');

-- Utilisateurs
CREATE TABLE utilisateurs (
  id SERIAL PRIMARY KEY,
  nom VARCHAR(255) NOT NULL,
  prenom VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
  mdp VARCHAR(255) NOT NULL,
  id_role INTEGER NOT NULL DEFAULT 3,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_role) REFERENCES roles(id)
);

-- Compétences
CREATE TABLE competences (
  id SERIAL PRIMARY KEY,
  nom VARCHAR(255) NOT NULL UNIQUE,
  slug VARCHAR(255) NOT NULL UNIQUE
);

INSERT INTO competences (nom, slug) VALUES
  ('Developper', 'developper'),
  ('Concevoir', 'concevoir'),
  ('Entreprendre', 'entreprendre'),
  ('Comprendre', 'comprendre'),
  ('Exprimer', 'exprimer');

-- Logiciels/Technologies
CREATE TABLE logiciels (
  id SERIAL PRIMARY KEY,
  nom VARCHAR(255) NOT NULL UNIQUE,
  slug VARCHAR(255) NOT NULL UNIQUE,
  image_url VARCHAR(500)
);

-- Types de projets
CREATE TABLE types_projets (
  id SERIAL PRIMARY KEY,
  nom VARCHAR(255) NOT NULL UNIQUE,
  slug VARCHAR(255) NOT NULL UNIQUE
);

INSERT INTO types_projets (nom, slug) VALUES
  ('Développement', 'programme'),
  ('Infographie', 'infographie'),
  ('Communication', 'texte');

-- Projets
CREATE TABLE projets (
  id SERIAL PRIMARY KEY,
  titre VARCHAR(255) NOT NULL,
  description TEXT,
  id_type INTEGER NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_type) REFERENCES types_projets(id)
);

-- Images projets
CREATE TABLE images_projets (
  id SERIAL PRIMARY KEY,
  id_projet INTEGER NOT NULL,
  url VARCHAR(500) NOT NULL,
  ordre INTEGER DEFAULT 0,
  FOREIGN KEY (id_projet) REFERENCES projets(id) ON DELETE CASCADE
);

-- Relation projet-compétence
CREATE TABLE projets_competences (
  id_projet INTEGER NOT NULL,
  id_competence INTEGER NOT NULL,
  PRIMARY KEY (id_projet, id_competence),
  FOREIGN KEY (id_projet) REFERENCES projets(id) ON DELETE CASCADE,
  FOREIGN KEY (id_competence) REFERENCES competences(id) ON DELETE CASCADE
);

-- Relation projet-logiciel
CREATE TABLE projets_logiciels (
  id_projet INTEGER NOT NULL,
  id_logiciel INTEGER NOT NULL,
  PRIMARY KEY (id_projet, id_logiciel),
  FOREIGN KEY (id_projet) REFERENCES projets(id) ON DELETE CASCADE,
  FOREIGN KEY (id_logiciel) REFERENCES logiciels(id) ON DELETE CASCADE
);

-- Commentaires
CREATE TABLE commentaires (
  id SERIAL PRIMARY KEY,
  id_projet INTEGER NOT NULL,
  id_utilisateur INTEGER NOT NULL,
  contenu TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_projet) REFERENCES projets(id) ON DELETE CASCADE,
  FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id) ON DELETE CASCADE
);

-- Index pour les recherches
CREATE INDEX idx_utilisateurs_email ON utilisateurs(email);
CREATE INDEX idx_projets_type ON projets(id_type);
CREATE INDEX idx_commentaires_projet ON commentaires(id_projet);
CREATE INDEX idx_images_projet ON images_projets(id_projet);
