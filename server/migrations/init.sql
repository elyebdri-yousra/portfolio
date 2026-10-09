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

-- Insert admin user
INSERT INTO utilisateurs (nom, prenom, email, mdp, id_role)
VALUES ('EL YEBDRI', 'Yousra', 'yousra.elyebdri@icloud.com', '$2a$10$fNML7aKXcpXi2n57BTOLF.uXrngL8M82V7Ui8DsFBkhFYSHjs5vPq', 1);

-- Logiciels/Technologies
CREATE TABLE logiciels (
  id SERIAL PRIMARY KEY,
  nom VARCHAR(255) NOT NULL UNIQUE,
  slug VARCHAR(255) NOT NULL UNIQUE,
  image_url VARCHAR(500)
);

INSERT INTO logiciels (nom, slug, image_url) VALUES
  ('CSS', 'css', '/storage/logiciel_img/css.png'),
  ('HTML', 'html', '/storage/logiciel_img/html.png'),
  ('JavaScript', 'javascript', '/storage/logiciel_img/js.webp'),
  ('Git', 'git', '/storage/logiciel_img/git.svg'),
  ('PHP', 'php', '/storage/logiciel_img/php.png'),
  ('MySQL', 'mysql', '/storage/logiciel_img/mysql.svg'),
  ('Tailwind CSS', 'tailwind', '/storage/logiciel_img/tailwind.png'),
  ('WordPress', 'wordpress', '/storage/logiciel_img/wordpress.png'),
  ('Figma', 'figma', '/storage/logiciel_img/apps-figma-icon-2048x2048-ctjj5ab7.png'),
  ('Illustrator', 'illustrator', '/storage/logiciel_img/illustratot.png'),
  ('InDesign', 'indesign', '/storage/logiciel_img/indesign.png'),
  ('Photoshop', 'photoshop', '/storage/logiciel_img/Adobe_Photoshop_CC_icon.svg.png'),
  ('Drupal', 'drupal', '/storage/logiciel_img/Logo_drupal_1779916164.png');

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

-- Tables About (Section À propos)
CREATE TABLE about_parcours (
  id SERIAL PRIMARY KEY,
  poste VARCHAR(255) NOT NULL,
  entreprise VARCHAR(255) NOT NULL,
  periode VARCHAR(100) NOT NULL,
  missions TEXT NOT NULL,
  ordre INTEGER DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE about_formation (
  id SERIAL PRIMARY KEY,
  titre VARCHAR(255) NOT NULL,
  etablissement VARCHAR(255) NOT NULL,
  contenu TEXT NOT NULL,
  ordre INTEGER DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE about_competence (
  id SERIAL PRIMARY KEY,
  categorie VARCHAR(255) NOT NULL,
  details TEXT NOT NULL,
  ordre INTEGER DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insertion des données About
INSERT INTO about_parcours (poste, entreprise, periode, missions, ordre) VALUES
('Apprentie Développeuse Web (Drupal)', 'Ministère de la Culture — Prestataire AlmaviaCX', '2025 — Aujourd''hui', 'Développement et maintenance de sites sous Drupal (v10/11)
Intégration front-end (HTML, CSS – DSFR) et adaptation UI/UX
Personnalisation de templates (Twig) et modules custom
Debug et résolution de bugs (front/back)
Gestion de versions avec Git / GitLab (branches, conflits)
Déploiement en local avec DDEV', 0),
('Apprentie Responsable Informatique', 'LASEM — Laboratoire d''Analyse, de Surveillance et d''Expertise de la Marine', '2021 — 2024', 'Refonte d''interface GED (UX/UI, accessibilité)
Automatisation de workflows
Développement VBA
Reporting SQL (JasperSoft)
Normes ISO 17025 et audits COFRAC', 1);

INSERT INTO about_formation (titre, etablissement, contenu, ordre) VALUES
('BUT Métiers du Multimédia et de l''Internet — En cours', 'IUT Toulon', 'Développement web (PHP, JS, Tailwind)
UX/UI et responsive design
Gestion de projet digital', 0),
('BTS Services Informatiques aux Organisations — 2022-2024', 'Lycée Bonaparte', 'HTML, CSS, JS, PHP
Symfony, Twig, POO
SQL & Git', 1);

INSERT INTO about_competence (categorie, details, ordre) VALUES
('Développement Web', 'PHP, JavaScript, HTML, CSS, Twig, Symphony', 0),
('CMS', 'Drupal, WordPress', 1),
('Base de données', 'SQL, MongoDB', 2),
('Outils & Environnement', 'Git, GitLab, Docker, DDEV, SaaS', 3),
('UI / UX', 'Figma, accessibilité (RGAA), DSFR', 4),
('Systèmes', 'Linux (Ubuntu), Windows', 5);

-- Insertion des projets
INSERT INTO projets (titre, description, id_type) VALUES
('Site vitrine Sport hivernal', 'Création d''un site vitrine et e-commerce pour MMI Sport de glisse', 1),
('Portfolio', 'Mon site portfolio personnel pour centraliser l''ensemble de mes productions académiques et professionnelles', 1),
('Site vitrine agence Graphtiel', 'Site web de mon agence fictive d''infographie, Graphtiel', 1),
('Refonte logiciel', 'Refonte graphique d''un logiciel de GED du Ministère de la Marine', 1),
('GSB', 'Application GSB Frais pour gestion des frais professionnels des visiteurs médicaux', 1),
('Grand mémorial', 'Mise en conformité RGAA sur la plateforme Grand Mémorial du Ministère de la Culture', 1),
('Planète Manga', 'Dispositif immersif en U avec 9 épreuves interactives basées sur des univers manga', 1);

-- Relations projet-compétence
INSERT INTO projets_competences (id_projet, id_competence) VALUES
(1, 1), (1, 4),
(2, 1), (2, 2), (2, 5),
(3, 1), (3, 3), (3, 5),
(4, 1),
(5, 1),
(6, 1), (6, 3),
(7, 1), (7, 2), (7, 3), (7, 4), (7, 5);

-- Relations projet-logiciel
INSERT INTO projets_logiciels (id_projet, id_logiciel) VALUES
(1, 1), (1, 4), (1, 2), (1, 5),
(2, 9), (2, 3), (2, 6), (2, 5), (2, 7), (2, 8),
(3, 8),
(4, 1),
(5, 1), (5, 2), (5, 6), (5, 5),
(6, 13), (6, 4), (6, 3), (6, 5),
(7, 1), (7, 4), (7, 3), (7, 7);

-- Images des projets
INSERT INTO images_projets (id_projet, url, ordre) VALUES
(1, '/storage/projects_img/vitrine1.jpeg', 0),
(1, '/storage/projects_img/vitrine2.jpeg', 1),
(1, '/storage/projects_img/vitrine3.jpeg', 2),
(1, '/storage/projects_img/vitrine4.jpeg', 3),
(1, '/storage/projects_img/vitrine5.jpeg', 4),
(1, '/storage/projects_img/vitrine6.jpeg', 5),
(1, '/storage/projects_img/vitrine7.jpeg', 6);

-- Index pour les recherches
CREATE INDEX idx_utilisateurs_email ON utilisateurs(email);
CREATE INDEX idx_projets_type ON projets(id_type);
CREATE INDEX idx_commentaires_projet ON commentaires(id_projet);
CREATE INDEX idx_images_projet ON images_projets(id_projet);
CREATE INDEX idx_about_parcours_ordre ON about_parcours(ordre);
CREATE INDEX idx_about_formation_ordre ON about_formation(ordre);
CREATE INDEX idx_about_competence_ordre ON about_competence(ordre);
