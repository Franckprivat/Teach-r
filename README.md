# Test technique Teach'r
 
<p align="center">
<img src="https://raw.githubusercontent.com/Franckprivat/Teach-r/refs/heads/main/frontend/src/Assets/logo-white.png" alt="Logo du projet" />
</p>
 
# Teach-r
 
## Description

Teach-r est un projet conçu pour Créer une application fullstack. Il combine un frontend moderne en React et un backend robuste en symfony, permettant une gestion fluide et efficace des fonctionnalités.
 
## Fonctionnalités

- Authentification des utilisateurs (Login et SignUp).

- Interface utilisateur intuitive pour naviguer entre les pages.

- Gestion des ressources dynamiques (backend et base de données).
 
## Technologies utilisées

### Frontend

- React

- TailwindCSS
 
### Backend

- Symfony

- MariaDB 
 
## Installation

### Prérequis

- Node.js >= 16

- npm ou yarn
 
### Étapes

1. Clonez ce dépôt :

   ```bash

   git@github.com:Franckprivat/Teach-r.git

 
2. Installez les dépendances :

   - Pour le frontend :

     ```bash

     cd frontend

     npm install

     ```

   - Pour le backend :

     ```bash

     cd ../backend/skeleton

     composer install


     ```
 
3. Configurez les fichiers d'environnement :

   - Pour le backend : Créez un fichier `.env` avec les variables suivantes :

     ```env

     PORT=8000

     DATABASE_URL=your_database_url

     ```
 
4. Lancez les serveurs :

   - Pour le frontend :

     ```bash

     cd frontend

     npm start

     ```

   - Pour le backend :

     ```bash

     cd backend

     symfony serve:start

     ```
 


 
