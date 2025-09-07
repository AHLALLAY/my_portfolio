# 🚀 Portfolio Backend API

API REST pour un portfolio développeur construit avec Laravel 12 et Laravel Sanctum.

## 📋 Description

Ce projet est un backend API pour un portfolio développeur qui permet d'afficher et de gérer des projets et compétences. L'API est conçue pour être utilisée avec un frontend Vue.js.

## 🏗️ Architecture

Le projet utilise une architecture en couches avec le pattern Repository/Service :

```
Interface → Repository → Service → Controller
```

### 📁 Structure des dossiers

```
app/
├── Http/
│   ├── Controllers/Api/     # Contrôleurs API
│   └── Requests/            # Classes de validation
├── Interfaces/              # Interfaces des repositories
├── Models/                  # Modèles Eloquent
├── Repositories/            # Implémentation des repositories
├── Services/                # Couche métier
└── Providers/               # Service providers
```

## 🗄️ Base de données

### Tables principales

- **`users`** - Utilisateurs (authentification)
- **`projects`** - Projets du portfolio
- **`skills`** - Compétences (hard/soft skills)
- **`project_skills`** - Table de liaison (many-to-many)

### Relations

- `Project` ↔ `Skill` (many-to-many via `project_skills`)
- `User` (authentification indépendante)

## 🛠️ Technologies utilisées

- **Laravel 12** - Framework PHP
- **Laravel Sanctum** - Authentification API
- **SQLite** - Base de données
- **PHP 8.2+** - Version PHP

## 🚀 Installation

### Prérequis

- PHP 8.2 ou supérieur
- Composer
- Node.js (pour les assets)

### Étapes d'installation

1. **Cloner le projet**
```bash
git clone <repository-url>
cd Code/Backend
```

2. **Installer les dépendances**
```bash
composer install
npm install
```

3. **Configuration de l'environnement**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Base de données**
```bash
# La base SQLite est déjà créée
php artisan migrate
php artisan db:seed
```

5. **Démarrer le serveur**
```bash
php artisan serve
```

L'API sera disponible sur `http://localhost:8000`

## 📚 Documentation API

### 🔐 Authentification

#### Connexion
```http
POST /api/auth/login
Content-Type: application/json

{
    "email": "abderrahmanahlalay76@gmail.com",
    "password": "wxcvbn@@@@0000"
}
```

#### Inscription
```http
POST /api/auth/register
Content-Type: application/json

{
    "name": "Nom Utilisateur",
    "email": "email@example.com",
    "password": "motdepasse",
    "password_confirmation": "motdepasse"
}
```

#### Déconnexion
```http
POST /api/auth/logout
Authorization: Bearer {token}
```

### 📊 Projets (Routes publiques)

#### Liste des projets
```http
GET /api/public/projects
```

#### Détail d'un projet
```http
GET /api/public/project/{id}
```

### 🎯 Compétences (Routes publiques)

#### Liste des compétences
```http
GET /api/public/skills
```

#### Détail d'une compétence
```http
GET /api/public/skill/{id}
```

### 👨‍💼 Administration (Routes protégées)

Toutes les routes admin nécessitent un token d'authentification.

#### Gestion des projets
```http
POST /api/admin/projects          # Créer un projet
PUT /api/admin/project/{id}       # Modifier un projet
DELETE /api/admin/project/{id}    # Supprimer un projet
```

#### Gestion des compétences
```http
POST /api/admin/skills            # Créer une compétence
PUT /api/admin/skill/{id}         # Modifier une compétence
DELETE /api/admin/skill/{id}      # Supprimer une compétence
```

#### Gestion des utilisateurs
```http
GET /api/users                    # Liste des utilisateurs
GET /api/users/{id}               # Détail d'un utilisateur
PUT /api/users/{id}               # Modifier un utilisateur
DELETE /api/users/{id}            # Supprimer un utilisateur
```

## 🔧 Configuration

### Utilisateur admin par défaut

- **Email** : `abderrahmanahlalay76@gmail.com`
- **Mot de passe** : `wxcvbn@@@@0000`

### Variables d'environnement importantes

```env
APP_NAME="Portfolio API"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite

SANCTUM_STATEFUL_DOMAINS=localhost:3000
```

## 🧪 Tests

```bash
# Lancer les tests
php artisan test

# Tests avec couverture
php artisan test --coverage
```

## 📦 Scripts disponibles

```bash
# Développement (serveur + queue + logs + vite)
composer run dev

# Tests
composer run test

# Linting
./vendor/bin/pint
```

## 🚀 Déploiement

### Production

1. **Configuration**
```bash
APP_ENV=production
APP_DEBUG=false
```

2. **Optimisation**
```bash
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

3. **Permissions**
```bash
chmod -R 755 storage bootstrap/cache
```

## 📝 Structure des réponses API

### Succès
```json
{
    "message": "Message de succès",
    "data": { ... },
    "status": "success"
}
```

### Erreur
```json
{
    "message": "Message d'erreur",
    "error": "Détails de l'erreur",
    "status": "failed"
}
```

## 🤝 Contribution

1. Fork le projet
2. Créer une branche feature (`git checkout -b feature/nouvelle-fonctionnalite`)
3. Commit les changements (`git commit -m 'Ajouter nouvelle fonctionnalité'`)
4. Push vers la branche (`git push origin feature/nouvelle-fonctionnalite`)
5. Ouvrir une Pull Request

## 📄 Licence

Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus de détails.

## 👨‍💻 Auteur

**Abderrahman Ahlalay**
- Email: abderrahmanahlalay76@gmail.com

---

*Développé avec ❤️ en Laravel*