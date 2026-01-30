<div align="center">

# 🥘 Cuisinet - Plateforme de Partage de Recettes

![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-000000?style=for-the-badge&logo=mysql)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css)

</div>

---

## 📖 Description

**Cuisinet** est une application web complète permettant aux passionnés de cuisine de partager, découvrir et interagir autour de recettes culinaires. 

Ce projet a été développé dans le cadre de ma formation, en mettant l'accent sur une architecture **MVC** propre, la sécurité des données et une expérience utilisateur fluide.

---

## ✨ Fonctionnalités Clés

### 👤 Gestion des Utilisateurs
* **Authentification sécurisée :** Inscription, Connexion, Logout.
* **Profils :** Gestion de profil et rôles utilisateurs.

### 🥘 Gestion des Recettes (CRUD)
* **Création :** Ajout de recettes avec ingrédients dynamiques et upload d'images.
* **Lecture :** Affichage détaillé avec instructions étape par étape.
* **Mise à jour & Suppression :** Gestion complète par l'auteur.

### 🔍 Recherche et Filtres
* **Recherche :** Recherche avancée par mots-clés ou ingrédients.
* **Filtrage :** Filtrage par catégories (Entrées, Plats, Desserts...).

### ❤️ Interactions Sociales
* **Favoris :** Système pour ajouter/retirer des recettes de sa liste de favoris.
* **Commentaires :** Espace de discussion pour donner son avis sur les recettes.

---

## 🛠️ Stack Technique

| Catégorie | Technologie |
| :--- | :--- |
| **Backend** | Laravel 11 (PHP 8.2+) |
| **Frontend** | Blade, Tailwind CSS, Alpine.js |
| **Base de Données** | MySQL |
| **Versionning** | Git & GitHub |

---
## 🏗️ Architecture du Répertoire (Repo Structure)

Ce dépôt a été restructuré pour séparer clairement la logique applicative de la documentation technique :

```text
📂 Projet-Recettes
│
├── 📂 cuisinet/       # CODE SOURCE (Application Laravel)
│   ├── app/           # Modèles, Contrôleurs, Logique métier
│   ├── resources/     # Vues (Blade), JS, CSS
│   ├── routes/        # Définition des routes web
│   └── ...
│
└── 📂 docs/           # DOCUMENTATION (Modélisation UML)
    ├── use_case.png   # Diagramme de Cas d'Utilisation
    ├── class.png      # Diagramme de Classes
    └── sequence.png   # Diagramme de Séquence


## 🚀 Installation et Démarrage

Pour lancer le projet localement, suivez ces étapes :

### 1. Cloner le projet
```bash
git clone https://github.com/AbdellahLemtiri/recipe-platform--laravel.git
cd recipe-platform--laravel/cuisinet

2. Installer les dépendances

```Bash
composer install
npm install && npm run build
3. Configuration d'environnement
Dupliquez le fichier .env.example, renommez-le en .env et générez la clé d'application :

```Bash

cp .env.example .env
php artisan key:generate
4. Base de données et Données de test

```Bash
php artisan migrate --seed
5. Lancer le serveur

``` Bash
php artisan serve
L'application sera accessible sur : http://127.0.0.1:8000

📝 Conception (UML)
La modélisation complète du projet (Diagrammes de Cas d'utilisation, Classes, Séquences) est disponible pour consultation dans le dossier /docs.

