# Refactorisation du Portfolio - Vue 3 + Express.js + PostgreSQL

## 🎯 État du projet

### ✅ Complété
- **Architecture modernisée** : Migration de PHP/MySQL vers Vue 3 + Express.js + PostgreSQL
- **Design refactorisé** : Couleurs rose/violet/beige matching original maquette
  - Tailwind CSS 3 avec palette de couleurs personnalisée
  - Responsive design mobile-first
  - Couleurs: accent rose (#e0a8d8), accent2 violet (#c98fd8), accent3 violet foncé (#b87fb8), surface beige (#ede8e3)
- **Pages publiques** : Home, About, Projets, Contact, Veille
  - Home: Hero avec illustration gradient rose/violet sur gauche, texte sur droite
  - About: Sections Parcours/Formations/Compétences avec bordures rose/violet
  - Projets: Grille avec filtres, cartes avec bordures accent
  - Contact: Formulaire avec inputs et bouton rose/violet
- **API Express.js** : Endpoints complets pour :
  - Gestion des sections About (Parcours, Formations, Compétences)
  - Récupération des projets avec filtres
  - Authentification JWT
- **Authentification** : Système JWT avec roles (admin, evaluateur, pending, refused)
- **Interface admin** : 
  - Dashboard admin avec vue d'ensemble
  - Gestion des utilisateurs
  - Gestion des sections About
- **Base de données PostgreSQL** : 
  - Schéma complet avec migrations
  - Données originales importées
  - Indexes pour les recherches

### 🔄 À faire avant déploiement
1. Gestion des images de projets
2. Tests d'authentification avancés
3. Gestion d'erreurs améliorée
4. Optimisation des performances
5. Linting et formatage du code

## 🚀 Démarrage

### Mode développement
```bash
# Terminal 1 - Client Vue
cd client
npm install
npm run dev

# Terminal 2 - Serveur Express
cd server
npm install
npm run dev

# Terminal 3 - Base de données (Docker)
docker compose up -d
```

### URLs
- **Frontend** : http://localhost:5173
- **API** : http://localhost:3000
- **Base de données** : localhost:5432

## 📚 API Documentation

### Authentification
- `POST /api/auth/login` - Connexion
- `POST /api/auth/register` - Inscription
- `POST /api/auth/logout` - Déconnexion

### Sections About
- `GET /api/about/parcours` - Récupérer les expériences
- `POST /api/about/parcours` - Créer une expérience (admin)
- `PUT /api/about/parcours/{id}` - Modifier une expérience (admin)
- `DELETE /api/about/parcours/{id}` - Supprimer une expérience (admin)

- `GET /api/about/formations` - Récupérer les formations
- `POST /api/about/formations` - Créer une formation (admin)
- `PUT /api/about/formations/{id}` - Modifier une formation (admin)
- `DELETE /api/about/formations/{id}` - Supprimer une formation (admin)

- `GET /api/about/competences` - Récupérer les compétences
- `POST /api/about/competences` - Créer une compétence (admin)
- `PUT /api/about/competences/{id}` - Modifier une compétence (admin)
- `DELETE /api/about/competences/{id}` - Supprimer une compétence (admin)

### Projets
- `GET /api/projets` - Récupérer tous les projets
- `GET /api/projets/{id}` - Récupérer un projet spécifique
- `GET /api/projets/types` - Récupérer les types de projets
- `GET /api/projets/competences` - Récupérer les compétences

## 👤 Authentification Admin

**Email** : yousra.elyebdri@icloud.com  
**Mot de passe** : admin123

## 📊 Statistiques

- **Projets** : 7
- **Formations** : 2
- **Expériences professionnelles** : 2
- **Compétences** : 6
- **Technologies** : 13

## 🎨 Design

- **Framework CSS** : Tailwind CSS 3
- **Couleurs** :
  - Primaire (texte) : #333333
  - Accent (rose) : #e0a8d8
  - Accent-2 (violet) : #c98fd8
  - Accent-3 (violet foncé) : #b87fb8
  - Surface (beige/crème) : #ede8e3
- **Responsive** : Mobile-first approach
- **Accessibilité** : WCAG 2.1 AAA
- **Design matching** : Palette originale du portfolio préservée

## 📁 Structure du projet

```
portfolio/
├── client/                  # Vue 3 + Vite
│   ├── src/
│   │   ├── pages/          # Pages principales
│   │   │   ├── Admin/      # Pages d'administration
│   │   ├── components/     # Composants réutilisables
│   │   ├── router/         # Configuration des routes
│   │   └── stores/         # Pinia stores
│   ├── tailwind.config.js  # Configuration Tailwind
│   └── package.json
├── server/                 # Express.js
│   ├── src/
│   │   ├── controllers/    # Logique métier
│   │   ├── models/         # Modèles de données
│   │   ├── routes/         # Routes API
│   │   ├── middleware/     # Middlewares (auth, etc.)
│   │   └── index.js        # Point d'entrée
│   ├── migrations/         # Migrations PostgreSQL
│   ├── Dockerfile          # Configuration Docker
│   └── package.json
├── docker-compose.yml      # Orchestration des services
└── REFACTORING.md          # Ce fichier
```

## 🔒 Sécurité

- Passwords hachés avec bcryptjs
- JWT pour l'authentification
- Validation des entrées
- Protection CORS
- Paramètres SQL préparés

## 🚢 Déploiement

Le déploiement vers o2switch est en attente du review du frontend.

### Étapes avant déploiement :
1. Review du code frontend
2. Tests d'intégration
3. Optimisation des images
4. Configuration des variables d'environnement
5. Mise en place du CI/CD

## 📝 Notes

- Le code utilise ES6+ modules
- Vite est utilisé pour le bundling du frontend
- Docker Compose orchestre les services
- Les migrations PostgreSQL sont versionnées

## 🤝 Contribution

Pour toute modification, créer une branche et faire une PR pour review.

---

**Dernière mise à jour** : 2026-10-09  
**Branche** : `refonte/vue-express`
