 _____ ______   ________  _________  ___  ___  ___  ________  ________           ________  ________  ___     
|\   _ \  _   \|\   __  \|\___   ___\\  \|\  \|\  \|\   __  \|\   ____\         |\   __  \|\   __  \|\  \    
\ \  \\\__\ \  \ \  \|\  \|___ \  \_\ \  \\\  \ \  \ \  \|\  \ \  \___|_        \ \  \|\  \ \  \|\  \ \  \   
 \ \  \\|__| \  \ \   __  \   \ \  \ \ \   __  \ \  \ \   __  \ \_____  \        \ \   __  \ \   ____\ \  \  
  \ \  \    \ \  \ \  \ \  \   \ \  \ \ \  \ \  \ \  \ \  \ \  \|____|\  \        \ \  \ \  \ \  \___|\ \  \ 
   \ \__\    \ \__\ \__\ \__\   \ \__\ \ \__\ \__\ \__\ \__\ \__\____\_\  \        \ \__\ \__\ \__\    \ \__\
    \|__|     \|__|\|__|\|__|    \|__|  \|__|\|__|\|__|\|__|\|__|\_________\        \|__|\|__|\|__|     \|__|
                                                                \|_________|                                 
                                                                                                             
ID: adresse1@caramail.gouv / password                                                                                                            



Voici une petit documentation sur le fonctionnement de l'API.

Tout d'abord l'API tourne sur Symfony, plus précisement API Platform.
Toutes les données stockées sur la BDD sont issues pour le moment de fixtures, permettant d'accomplir le MVP avant même de passer en production.
l'API fonctionne pour l'instant en local, pour les mêmes raisons.



1. Base de donnée

-Pour utiliser l'api sur votre machine, la première étape est de créer une base de donnée locale ou à distance en se servant des identifiants sur le .env
-Dans la mesure où l'API est partagée ou publiée, il est préférable de miser sur une second fichier .env.local où les données les plus sensibles telles que la passphrase ou encore les identifiants de BDD seront ignorés par GitHub.

2. Data Fixtures

-Afin de pouvoir utiliser l'API, il est nécessaire de posséder une base de donnée contenant les informations nécessaires à leur traitement. Pour se faire et en dépit de data "réelle" des fixtures seront générées afin de remplir la base de donnée avec des données factices permettant l'utilisation de l'API dans un premier temps. (voir fichier src>DataFixtures>AppFixtures.php)
-Lorsque les fixtures semblent correctes et que la base de donnée est fonctionnelle, on utilise la commande "php bin/console doctrine:fixtures:load" afin de remplir la base de données avec les fixtures générées.

3. Identifiaction

-Pour pouvoir effectuer les premières requêtes avec les données générées par les fixtures, on lance le serveur Symfony "php bin/console server:run" afin de pouvoir travailler sur notre environnement local.
-Une fois le serveur lancé, on se rend sur l'URL : "127.0.0.1:8000/api/login" directement sur Postman afin de s'identifier et récupérer son Token de connexion.
-Par une requête POST, on entre le champ "email" contenant "adresse1@caramail.gouv" puis le champ "password" contenant "password" directement dans le header (grâce à une route créée à cette occasion).
-On récupère le token de connexion directement dans le body reçu de Postman et on le stock dans le cache.

4. Requêtes

-Il existe plusieurs méthodes pour effectuer les premières requêtes dites CRUD sur notre API
-Une de ces méthodes consiste à se rendre sur l'URL "http://127.0.0.1:8000/api/docs" afin de consulter les différentes tables (l'interface graphique est proposée par api platform)
-L'API étant sécurisée, la première étape est de cliquer sur le bouton "Authorize" en haut à droite et d'y entrer le token généré précédement sur Postman "Bearer [TOKEN]".
-Une fois authentifié, il est possible de tester les requêtes en choisissant leur nature et la table sur lesquelles les executer.
-La première ligne devrait être la table classe et une requête GET et parceque nous somme identifiés nous pouvons dors et déjà appuyer sur "execute" pour afficher la première page des classes ainsi que les informations qu'elles contiennent, sois la méthode GET en somme.
