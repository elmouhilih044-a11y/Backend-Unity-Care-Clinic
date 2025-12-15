
# Unity Care Clinic – Backend (PHP Procedural)

## Description

Ce projet consiste à développer la première version du **backend** de la plateforme **Unity Care Clinic** en utilisant **PHP procédural (PHP 8.5)** et **MySQLi**.
Il permet la gestion des principales entités d’une clinique via une interface d’administration simple et claire.

## Objectifs

* Mettre en place un backend fonctionnel et sécurisé
* Gérer les entités principales de la clinique (patients, médecins, départements)
* Fournir un **tableau de bord** avec des statistiques globales
* Appliquer les bonnes pratiques en PHP procédural

##  Technologies utilisées

* PHP 8.5 (Procédural)
* MySQL / MySQLi
* HTML / CSS / JavaScript
* Chart.js (statistiques)
* AJAX (optionnel)

## Structure du projet

project/
│── config/
│   └── db.php
│── functions/
│   └── helpers.php
│── patients/
│   ├── add.php
│   ├── edit.php
│   ├── delete.php
│   └── list.php
│── doctors/
│── departments/
│── dashboard/
│   └── index.php
│── lang/
│   ├── fr.php
│   └── en.php
│── assets/
│── index.php
│── README.md
│── database.sql



## Base de données

La base de données contient les tables suivantes :

* **patients**
* **doctors**
* **departments**

Les relations sont définies (un médecin appartient à un département).

Le script SQL est disponible dans le fichier : `database.sql`.

## Fonctionnalités

* CRUD complet pour :

  * Patients
  * Médecins
  * Départements
* Tableau de bord avec :

  * Nombre total de patients
  * Nombre total de médecins
  * Nombre de départements
  * Graphiques statistiques
* Internationalisation (FR / EN)
* Sécurité avec requêtes préparées

## Sécurité

* Utilisation des **requêtes préparées** (Prepared Statements)
* Validation et sanitisation des données utilisateur
* Protection contre les attaques XSS


## Auteur

Projet réalisé dans le cadre d’un travail individuel (Backend PHP).


## Dates

* Lancement : 04/12/2025
* Date limite de rendu : 18/12/2025
