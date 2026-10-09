-- Import des données originales du portfolio Yousra EL YEBDRI
-- Migré de MySQL/MariaDB vers PostgreSQL

-- Tables About (page À propos)
INSERT INTO about_parcours (id, poste, entreprise, periode, missions, ordre) VALUES
(1, 'Apprentie Développeuse Web (Drupal)', 'Ministère de la Culture — Prestataire AlmaviaCX', '2025 — Aujourd''hui', 'Développement et maintenance de sites sous Drupal (v10/11)
Intégration front-end (HTML, CSS – DSFR) et adaptation UI/UX
Personnalisation de templates (Twig) et modules custom
Debug et résolution de bugs (front/back)
Gestion de versions avec Git / GitLab (branches, conflits)
Déploiement en local avec DDEV', 0),
(2, 'Apprentie Responsable Informatique', 'LASEM — Laboratoire d''Analyse, de Surveillance et d''Expertise de la Marine', '2021 — 2024', 'Refonte d''interface GED (UX/UI, accessibilité)
Automatisation de workflows
Développement VBA
Reporting SQL (JasperSoft)
Normes ISO 17025 et audits COFRAC', 1);

INSERT INTO about_formation (id, titre, etablissement, contenu, ordre) VALUES
(1, 'BUT Métiers du Multimédia et de l''Internet — En cours', 'IUT Toulon', 'Développement web (PHP, JS, Tailwind)
UX/UI et responsive design
Gestion de projet digital', 0),
(2, 'BTS Services Informatiques aux Organisations — 2022-2024', 'Lycée Bonaparte', 'HTML, CSS, JS, PHP
Symfony, Twig, POO
SQL & Git', 1);

INSERT INTO about_competence (id, categorie, details, ordre) VALUES
(1, 'Développement Web', 'PHP, JavaScript, HTML, CSS, Twig, Symphony', 0),
(2, 'CMS', 'Drupal , wordpress', 1),
(3, 'Base de données', 'SQL, MongoDB', 2),
(4, 'Outils & Environnement', 'Git, GitLab, Docker, DDEV, Saas', 3),
(5, 'UI / UX', 'Figma, accessibilité (RGAA), DSFR', 4),
(6, 'Systèmes', 'Linux (Ubuntu), Windows', 5);

-- Tables Projets
INSERT INTO competences (id, nom) VALUES
(1, 'Developper'),
(2, 'Concevoir'),
(3, 'Entreprendre'),
(4, 'Comprendre'),
(5, 'Exprimer');

INSERT INTO logiciel (id, nomLogiciel, urlimg) VALUES
(1, 'CSS', './storage/logiciel_img/css.png'),
(2, 'HTML', './storage/logiciel_img/html.png'),
(3, 'JS', './storage/logiciel_img/js.webp'),
(4, 'Git', './storage/logiciel_img/git.svg'),
(5, 'PHP', './storage/logiciel_img/php.png'),
(6, 'MySQL', './storage/logiciel_img/mysql.svg'),
(8, 'test', './storage/logiciel_img/vitrine6.jpeg'),
(9, 'Tailwind css', './storage/logiciel_img/tailwind.png'),
(10, 'wordpress', './storage/logiciel_img/wordpress.png'),
(11, 'Figma', './storage/logiciel_img/apps-figma-icon-2048x2048-ctjj5ab7.png'),
(12, 'Illustrator', './storage/logiciel_img/illustratot.png'),
(13, 'inDesign', './storage/logiciel_img/indesign.png'),
(14, 'Photoshop', './storage/logiciel_img/Adobe_Photoshop_CC_icon.svg.png'),
(15, 'Drupal', './storage/logiciel_img/Logo_drupal_1779916164.png');

-- Projets avec descriptions complètes
-- Note: Les descriptions complètes sont trop longues, vous pouvez les ajouter manuellement via le portfolio admin
INSERT INTO projets (id, titre, description, date, dateCrea, apprentissageCritique, typeProjet, argumentaire, idUser) VALUES
(46, 'Site vitrine Sport hivernal', 'Création d''un site vitrine et e-commerce pour MMI Sport de glisse', '2025-04-24', 2025, 'Logique de panier sans BDD', 'programme', 'Exploitation autonome d''environnement de développement', 3),
(47, 'Portfolio', 'Mon site portfolio personnel pour centraliser l''ensemble de mes productions académiques et professionnelles', '2025-05-25', 2025, 'Gestion des rôles et des permissions', 'programme', 'Architecture MVC', 3),
(48, 'Site vitrine agence Graphtiel', 'Site web de mon agence fictive d''infographie, Graphtiel', '2025-05-20', 2025, 'Gestion de projet avec contraintes budgétaires', 'programme', 'Personnalisation d''application avec CMS', 3),
(49, 'Refonte logiciel', 'Refonte graphique d''un logiciel de GED du Ministère de la Marine', '2025-06-03', 2023, 'Accès restreint au code source', 'programme', 'Exploitation d''environnement restreint', 3),
(50, 'GSB', 'Application GSB Frais pour gestion des frais professionnels des visiteurs médicaux', '2025-06-03', 2024, 'Intégration de logique métier complexe', 'programme', 'Architecture MVC et sécurisation des données', NULL),
(56, 'Grand mémorial', 'Mise en conformité RGAA sur la plateforme Grand Mémorial du Ministère de la Culture', '2026-05-27', 2026, 'Découverte d''un référentiel normatif', 'programme', 'Conformité légale et accessibilité', 3),
(57, 'Planète Manga', 'Dispositif immersif en U avec 9 épreuves interactives basées sur des univers manga', '2026-06-15', 2, 'Fiabilité de détection gestuelle avec ml5.js', 'programme', 'Développement de dispositifs interactifs', 3);

INSERT INTO projet_competence (id, id_projet, id_competence) VALUES
(4, 46, 1),
(5, 46, 4),
(7, 48, 1),
(8, 48, 3),
(9, 48, 5),
(10, 49, 1),
(11, 50, 1),
(30, 47, 1),
(31, 47, 2),
(32, 47, 5),
(56, 56, 1),
(57, 56, 3),
(58, 57, 1),
(59, 57, 2),
(60, 57, 3),
(61, 57, 4),
(62, 57, 5);

INSERT INTO logicielUse (id, idProjet, url_img, idLogiciel) VALUES
(60, 46, './storage/logiciel_img/css.png', 1),
(61, 46, './storage/logiciel_img/git.svg', 4),
(62, 46, './storage/logiciel_img/html.png', 2),
(63, 46, './storage/logiciel_img/php.png', 5),
(68, 48, './storage/logiciel_img/wordpress.png', 10),
(69, 49, './storage/logiciel_img/css.png', 1),
(70, 50, './storage/logiciel_img/css.png', 1),
(71, 50, './storage/logiciel_img/html.png', 2),
(72, 50, './storage/logiciel_img/mysql.svg', 6),
(73, 50, './storage/logiciel_img/php.png', 5),
(112, 47, './storage/logiciel_img/apps-figma-icon-2048x2048-ctjj5ab7.png', 11),
(113, 47, './storage/logiciel_img/html.png', 2),
(114, 47, './storage/logiciel_img/js.webp', 3),
(115, 47, './storage/logiciel_img/mysql.svg', 6),
(116, 47, './storage/logiciel_img/php.png', 5),
(117, 47, './storage/logiciel_img/tailwind.png', 9),
(166, 56, './storage/logiciel_img/Logo_drupal_1779916164.png', 15),
(167, 56, './storage/logiciel_img/git.svg', 4),
(168, 56, './storage/logiciel_img/js.webp', 3),
(169, 56, './storage/logiciel_img/php.png', 5),
(170, 57, './storage/logiciel_img/css.png', 1),
(171, 57, './storage/logiciel_img/git.svg', 4),
(172, 57, './storage/logiciel_img/js.webp', 3),
(173, 57, './storage/logiciel_img/tailwind.png', 9);

INSERT INTO projet_img (id, nom, img_path, id_projet, ordre) VALUES
(91, 'vitrine1.jpeg', './storage/projects_img/vitrine1.jpeg', 46, 0),
(92, 'vitrine2.jpeg', './storage/projects_img/vitrine2.jpeg', 46, 1),
(93, 'vitrine3.jpeg', './storage/projects_img/vitrine3.jpeg', 46, 2),
(94, 'vitrine4.jpeg', './storage/projects_img/vitrine4.jpeg', 46, 3),
(95, 'vitrine5.jpeg', './storage/projects_img/vitrine5.jpeg', 46, 4),
(96, 'vitrine6.jpeg', './storage/projects_img/vitrine6.jpeg', 46, 5),
(97, 'vitrine7.jpeg', './storage/projects_img/vitrine7.jpeg', 46, 6);
