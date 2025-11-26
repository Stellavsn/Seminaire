# Seminaire
Projet de BTS SIO 2

Projet API REST CRUD (Étudiant) en PHP et MySQL

📚 Introduction

Ce projet implémente une API RESTful simple pour gérer une ressource unique : l'entité Étudiant. Développée en PHP natif (sans framework) et utilisant une base de données MySQL avec l'extension PDO pour la persistance des données, cette API supporte les quatre opérations fondamentales : CRUD (Create, Read, Update, Delete).

L'API utilise des URLs propres grâce à la réécriture d'URL (.htaccess) et communique exclusivement en utilisant le format JSON.

🎯 Objectifs du Projet

Ce projet a plusieurs objectifs pédagogiques et techniques :

Maîtriser l'Architecture REST : Comprendre et appliquer les contraintes du style architectural REST (utilisation des méthodes HTTP GET, POST, PUT, DELETE pour les opérations CRUD).

Développement Backend en PHP : Implémenter une logique côté serveur en PHP pur, en séparant la couche de connexion (Database) de la couche métier (Etudiant).

Persistance des Données : Utiliser MySQL et PDO (PHP Data Objects) pour établir une connexion sécurisée et effectuer les requêtes de manipulation de données.

Routage RESTful : Configurer la réécriture d'URL via le fichier .htaccess pour obtenir des URLs propres et sémantiques.

Communication JSON : Assurer l'encodage et le décodage des données au format JSON, le standard de facto pour les API Web.

Test Client/Serveur : Simuler l'interaction avec l'API en utilisant l'outil cURL ou Postman.

🛠 Technologies Utilisées

Langage : PHP (Version 7.4+)

Base de données : MySQL

Connexion BD : PDO

Serveur : Apache (avec mod_rewrite activé) ou Nginx

Client de Test : Postman ou les scripts cURL fournis.

🚀 Configuration du Projet

Suivez ces étapes pour mettre l'API en service sur votre environnement de développement local (ex: XAMPP, WAMP, MAMP, Docker).

1. Configuration de la Base de Données

Créez une base de données MySQL nommée, par exemple, api_rest_db.

Exécutez le script SQL fourni (etudiant.sql) pour créer la table etudiant :

CREATE TABLE `etudiant` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `nom` VARCHAR(255) NOT NULL,
    `prenom` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `age` INT(3) NOT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
);





2. Configuration des Connexions

Modifiez le fichier config/database.php pour insérer vos identifiants de connexion MySQL :

// Fichier: config/database.php
private $host = "votre_hôte"; 
private $database_name = "api_rest_db"; 
private $username = "votre_utilisateur"; 
private $password = "votre_mot_de_passe";





3. Structure des Fichiers

Assurez-vous que la structure de vos fichiers respecte la hiérarchie suivante :

/
├── api/
│   ├── etudiant.php       # Point d'entrée
│   └── .htaccess          # Réécriture d'URL
├── config/
│   └── database.php       # Connexion BD
├── class/
│   └── classe_etudiant.php # Logique CRUD
└── client/                # Dossier des exemples clients cURL





4. Configuration Apache (.htaccess)

Le fichier api/.htaccess est crucial pour le routage RESTful. Il permet de transformer les URLs propres en requêtes PHP compréhensibles :

RewriteEngine On
RewriteRule ^etudiant/?$ etudiant.php [NC,L]
RewriteRule ^etudiant/(\d+)$ etudiant.php?id=$1 [NC,L]





🌐 Endpoints de l'API

L'URL de base pour ce projet est supposée être http://apirest/api/.

Toutes les réponses de l'API sont retournées au format JSON.

Méthode HTTP

Endpoint

Description

Données Requises

GET

/etudiant

Récupère la liste de tous les étudiants.

Aucune

GET

/etudiant/{id}

Récupère les détails d'un étudiant par son ID.

ID dans l'URL

POST

/etudiant

Crée un nouvel étudiant.

nom, prenom, email, age

PUT

/etudiant/{id}

Met à jour un étudiant existant.

ID dans l'URL + données PUT

DELETE

/etudiant/{id}

Supprime un étudiant par son ID.

ID dans l'URL

Exemple de Requête POST (Création)

Pour ajouter un nouvel étudiant, vous devez envoyer les données encodées (généralement application/x-www-form-urlencoded) :

URL : http://apirest/api/etudiant

Méthode : POST

Corps (x-www-form-urlencoded) :

nom=Dupont
prenom=Alice
email=alice.dupont@exemple.com
age=22





Réponse attendue :

{
    "message": "Etudiant créé"
}





🧩 Structure de la Réponse JSON

Une réponse réussie pour la lecture de tous les étudiants (GET /etudiant) retourne un tableau d'objets :

[
    {
        "id": 1,
        "nom": "Dupont",
        "prenom": "Alice",
        "email": "alice.dupont@exemple.com",
        "age": 22,
        "created_at": "2023-11-26 10:00:00"
    },
    {
        "id": 2,
        // ...
    }
]





🧪 Tester l'API avec cURL

Les fichiers du dossier client/ peuvent être utilisés comme référence pour tester l'API en ligne de commande ou via un autre script PHP.

Exemple de test en ligne de commande (simulant un GET All) :

curl -X GET http://apirest/api/etudiant


