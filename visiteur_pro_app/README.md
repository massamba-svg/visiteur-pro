<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

<p align="center">
  <img src="https://img.icons8.com/fluency/96/guest-male.png" width="80" alt="Visiteur Pro Logo"/>
</p>

<h1 align="center">Visiteur Pro</h1>

<p align="center">
  <strong>Application de gestion des visites professionnelles</strong>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel"/>
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP"/>
  <img src="https://img.shields.io/badge/Tailwind_CSS-3.x-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white" alt="Tailwind"/>
  <img src="https://img.shields.io/badge/Alpine.js-3.x-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white" alt="Alpine.js"/>
</p>

---

## 📋 À propos

**Visiteur Pro** est une application web complète permettant de gérer les visites dans un environnement professionnel. Elle offre un suivi en temps réel des visiteurs, la gestion des clients, la génération de rapports et un système de contrôle d'accès basé sur les rôles.

### ✨ Fonctionnalités principales

- 📊 **Tableau de bord** - Statistiques en temps réel et graphiques de tendances
- 📅 **Gestion des visites** - Enregistrement, suivi et clôture des visites
- 👥 **Gestion des clients** - Base de données clients complète
- 📜 **Historique** - Consultation et recherche dans l'historique des visites
- 📈 **Rapports** - Génération de rapports avec export PDF
- 🔐 **Gestion des rôles** - Système de permissions granulaire
- ⚙️ **Paramètres** - Personnalisation de l'interface utilisateur

---

## 🏗️ Architecture

### Stack Technique

| Technologie | Version | Description |
|-------------|---------|-------------|
| Laravel | 12.x | Framework PHP backend |
| PHP | 8.2+ | Langage serveur |
| MySQL | 8.x | Base de données |
| Tailwind CSS | 3.x | Framework CSS |
| Alpine.js | 3.x | Framework JavaScript |
| Vite | 7.x | Build tool frontend |
| DomPDF | - | Génération de PDF |

### Structure du Projet

```
visiteur_pro_app/
├── app/
│   ├── Http/
│   │   ├── Controllers/     # Contrôleurs de l'application
│   │   ├── Middleware/      # Middleware (CheckRole)
│   │   └── Requests/        # Form Requests
│   ├── Models/              # Modèles Eloquent
│   └── Providers/           # Service Providers
├── database/
│   ├── factories/           # Factories pour les tests
│   ├── migrations/          # Migrations de base de données
│   └── seeders/             # Seeders (rôles, utilisateurs)
├── resources/
│   ├── css/                 # Fichiers CSS par module
│   ├── js/                  # Fichiers JavaScript
│   └── views/               # Vues Blade
├── routes/
│   ├── web.php              # Routes principales
│   └── auth.php             # Routes d'authentification
└── tests/                   # Tests Pest PHP
```

---

## 📊 Modèle de Données

```
┌─────────────┐       ┌─────────────┐       ┌─────────────┐
│    Role     │       │    User     │       │   Client    │
├─────────────┤       ├─────────────┤       ├─────────────┤
│ id          │◄──────│ role_id     │       │ id          │
│ name        │       │ id          │       │ first_name  │
│ description │       │ name        │       │ last_name   │
└─────────────┘       │ first_name  │       │ company     │
                      │ email       │       │ email       │
                      │ password    │       │ phone       │
                      └──────┬──────┘       │ address     │
                             │              └──────┬──────┘
                             │                     │
                             │    ┌─────────────┐  │
                             │    │    Visit    │  │
                             │    ├─────────────┤  │
                             └───►│ user_id     │◄─┘
                                  │ client_id   │
                                  │ visitor_name│
                                  │ person_met  │
                                  │ reason      │
                                  │ arrival_time│
                                  │ departure_  │
                                  │ status      │
                                  └─────────────┘
```

---

## 🔐 Système de Rôles

L'application dispose de 3 rôles avec des permissions différentes :

| Permission | Réceptionniste | Gestionnaire | Administrateur |
|------------|:--------------:|:------------:|:--------------:|
| Voir le tableau de bord | ✅ | ✅ | ✅ |
| Enregistrer une visite | ✅ | ✅ | ✅ |
| Terminer une visite | ✅ | ✅ | ✅ |
| Consulter les clients | ✅ | ✅ | ✅ |
| Voir l'historique | ✅ | ✅ | ✅ |
| Modifier une visite | ❌ | ✅ | ✅ |
| Supprimer une visite | ❌ | ✅ | ✅ |
| Gérer les clients (CRUD) | ❌ | ✅ | ✅ |
| Voir les rapports | ❌ | ✅ | ✅ |
| Exporter en PDF | ❌ | ✅ | ✅ |
| Supprimer des clients | ❌ | ❌ | ✅ |
| Gérer les utilisateurs | ❌ | ❌ | ✅ |
| Gérer les rôles | ❌ | ❌ | ✅ |

---

## 🚀 Installation

### Prérequis

- PHP 8.2 ou supérieur
- Composer
- Node.js 18+ et npm
- MySQL 8.x
- Git

### Installation rapide

```bash
# 1. Cloner le repository
git clone https://github.com/massamba-svg/visiteur-pro.git
cd visiteur-pro/visiteur_pro_app

# 2. Installation automatique
composer setup
```

### Installation manuelle

```bash
# 1. Installer les dépendances PHP
composer install

# 2. Copier le fichier d'environnement
cp .env.example .env

# 3. Générer la clé d'application
php artisan key:generate

# 4. Configurer la base de données dans .env
# DB_DATABASE=visiteur_pro_app
# DB_USERNAME=root
# DB_PASSWORD=

# 5. Exécuter les migrations et seeders
php artisan migrate --seed

# 6. Installer les dépendances frontend
npm install

# 7. Compiler les assets
npm run build
```

---

## ⚡ Lancement

### Mode développement

```bash
# Lance le serveur, la queue et Vite simultanément
composer dev
```

Ou manuellement dans des terminaux séparés :

```bash
# Terminal 1 - Serveur Laravel
php artisan serve

# Terminal 2 - Vite (hot reload)
npm run dev

# Terminal 3 - Queue (optionnel)
php artisan queue:listen
```

### Accès à l'application

- **URL** : http://localhost:8000
- **Admin** : admin@karasamb.com / password
- **Gestionnaire** : gestionnaire@karasamb.com / password

---

## 🧪 Tests

```bash
# Exécuter tous les tests
composer test

# Ou directement avec Pest
php artisan test
```

---

## 📁 Routes Principales

| Méthode | Route | Description | Accès |
|---------|-------|-------------|-------|
| GET | `/dashboard` | Tableau de bord | Tous |
| GET | `/visits` | Liste des visites | Tous |
| POST | `/visits` | Créer une visite | Tous |
| GET | `/clients` | Liste des clients | Tous |
| GET | `/history` | Historique des visites | Tous |
| GET | `/reports` | Rapports d'activité | Admin, Gestionnaire |
| GET | `/roles` | Gestion des rôles | Admin |
| GET | `/settings` | Paramètres | Tous |
| GET | `/help` | Centre d'aide | Tous |

---

## 🛠️ Configuration

### Variables d'environnement principales

```env
APP_NAME="Visiteur Pro"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=visiteur_pro_app
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=database
QUEUE_CONNECTION=database
CACHE_STORE=database
```

---

## 👥 Équipe de Développement

Ce projet a été développé dans le cadre du cours de **Développement Back-End** - STIC3.

---

## 📄 Licence

Ce projet est sous licence MIT. Voir le fichier [LICENSE](LICENSE) pour plus de détails.

---

<p align="center">
  <sub>Développé avec ❤️ en Laravel 12</sub>
</p>
