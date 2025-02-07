# Projet de gestion de tournois de football

Ce projet est une application web permettant de gérer des tournois de football, avec des fonctionnalités telles que la création d'équipes, l'inscription aux tournois, et la gestion des profils utilisateurs.

## Fonctionnalités

- **Gestion des utilisateurs** : Inscription, connexion et gestion du profil.
- **Gestion des équipes** : Créer une équipe, rejoindre une équipe existante, afficher les équipes créées.
- **Gestion des tournois** : Créer un tournoi, s'inscrire à un tournoi, voir les détails des tournois.
- **Dashboard** : Visualisation des informations personnelles et des tournois disponibles.

## Prérequis

Pour faire fonctionner ce projet, tu dois avoir les éléments suivants installés sur ta machine :

- PHP >= 7.4
- Composer
- Symfony CLI
- Une base de données (MySQL ou SQLite)
- Node.js et npm (pour les assets frontend)

## Installation

1. Clone ce repository sur ta machine :
    ```bash
    git clone https://github.com/ton-utilisateur/ton-repository.git
    cd ton-repository
    ```

2. Installe les dépendances PHP avec Composer :
    ```bash
    composer install
    ```

3. Installe les dépendances frontend (JS et CSS) :
    ```bash
    npm install
    ```


4. Lancer le serveur Symfony :
    ```bash
    symfony server:start 
    ```

5. Accède à l'application via `http://localhost:8000`.

## Structure du projet

Le projet suit une architecture Symfony avec les fonctionnalités principales :

- `src/Controller/` : Contient tous les contrôleurs de l'application.
- `src/Entity/` : Contient les entités (modèles) liées à la base de données.
- `templates/` : Contient les fichiers de vues Twig.
- `public/` : Contient les fichiers publics (images, CSS, JS).
- `config/` : Contient les configurations du projet.

